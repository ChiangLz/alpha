<?php
include ("../model/model_servicios.php");
include ("../model/liga_BD.php");


if(isset($_POST['select_servicio']) && isset($_POST['contacto']) && isset($_POST['select_unidad'])){

    $idc=$_POST['idc'];
    $ids=$_POST['ids'];
    $select_cliente1=$_POST['contacto'];
    $select_servicio=$_POST['select_servicio'];
    $select_unidad=$_POST['select_unidad'];
    $fecha_inicial=$_POST['fecha_inicial'];

    $fecha_final=$_POST['fecha_final'];
    $timeI=$_POST['timeI'];
    $timeF=$_POST['timeF'];
    $select_transportar=$_POST['area_trabajo'];
    $kilometraje=$_POST['kilometraje'];
    $monto_deposito=$_POST['monto_deposito'];
    $valor_pagare=$_POST['valor_pagare'];
    $direcol=$_POST['direcol'];
    $direntrega=$_POST['direntrega'];
    $cddes=$_POST['cddes'];
    $timeR=$_POST['timeR'];
    $timeC=$_POST['timeC'];
    $ff= "";
    $fi= "";
    $bandera= false;
    $fecha_inicial1= date("Y", strtotime("$fecha_inicial"));
    $fecha_inicialmes1= date("m", strtotime("$fecha_inicial"));
    $fecha_inicialdia1= date("d", strtotime("$fecha_inicial"));
    $fecha_inicial_completa = date("Y-m-d", strtotime("$fecha_inicial"));
     //datos del POST AÑO Y MES DE FECHA FINAL
    $fecha_final1= date("Y", strtotime("$fecha_final"));
    $fecha_finalmes1= date("m", strtotime("$fecha_final"));
    $fecha_finaldia1= date("d", strtotime("$fecha_final"));
    $fecha_final_completa = date("Y-m-d", strtotime("$fecha_final"));
       //datos del CONSUTLA AÑO Y MES DE FECHA FINAL
       $did2= date("d", strtotime("$fecha_inicial"));
       $dfd2= date("d", strtotime("$fecha_final"));
       $mid2= date("m", strtotime("$fecha_inicial"));
       $mfd2= date("m", strtotime("$fecha_final"));
   
    if($select_servicio != 2){
        $sql="SELECT * FROM `calendario` 
        WHERE iduni=$select_unidad AND idscr=$ids AND estado='ocupado' AND 
        ((MONTH(fechaini) >= $fecha_inicialmes1 AND DAY(fechaini) <= $fecha_inicialdia1) AND ($fecha_finalmes1 <= MONTH(fechafin) AND $fecha_finaldia1 <= DAY(fechafin)) 
        OR (MONTH(fechafin) = $fecha_inicialmes1 AND $fecha_inicialdia1 BETWEEN DAY(fechaini) AND DAY(fechafin)))";
    }else{
        $sql = "SELECT * FROM `calendario` 
        WHERE iduni=$select_unidad AND idscr=$ids AND estado='ocupado' AND 
        ((MONTH(fechaini) >= $fecha_inicialmes1 AND DAY(fechaini) <= $fecha_inicialdia1) AND ($fecha_finalmes1 <= MONTH(fechafin) AND $fecha_finaldia1 <= DAY(fechafin) AND '$timeI' <= horafin) 
        OR (MONTH(fechafin) = $fecha_inicialmes1 AND $fecha_inicialdia1 BETWEEN DAY(fechaini) AND DAY(fechafin) AND '$timeI' < horafin))";
    }
   $result=mysqli_query($link,$sql);
        while ($row1 = mysqli_fetch_assoc($result)) {

            $diBD= date("d", strtotime($row1['fechaini']));
            $dfBD= date("d", strtotime($row1['fechafin']));
            $miBD= date("m", strtotime($row1['fechaini']));
            $mfBD= date("m", strtotime($row1['fechafin']));
            #2021-06-30 and 2021-07-03
            #2021-06-30 and 2021-07-01
            $bandera = false;
            #echo $mid2. ">=" .$miBD;
            #echo "\n";
            if($mid2 >= $miBD){
                #echo $did2. ">=" .$diBD;
                #echo "\n";
                if($did2 >= $diBD){
                    $bandera = true;
                }
            }
            #echo $mfd2. "<=". $mfBD;
            #echo "\n";
            if($mfd2 <= $mfBD){
                #echo $dfd2. "<=". $dfBD;
                #echo "\n";
                if($dfd2 <= $dfBD){
                    $bandera = true;
                }
            }
           #echo $bandera;
        }
     if($bandera==true){
        //echo "dias ocupados Seleccione otras fechas";
        $dias=new consul();
        $diasOcupados=$dias->diasOcupados();
        //$diasOcupados="La unidad esta Ocupado";
     }
     if($bandera==false){
       
                $fecha = date('Y-m-d');
                $variables = "'" . $select_cliente1 . "'";
                $sql = "INSERT INTO debug(id, function_name, date_in, variables) values
                ('', 'getClient', '$fecha', $variables)";
                $insert_debug=mysqli_query($link,$sql);

                $data = explode("-",$select_cliente1);
                $sql="SELECT * FROM cliente WHERE id='".$data[0]."'";
                #echo $sql;
                $result=mysqli_query($link,$sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    #echo $row['id'];
                    $select_cliente=$row['id'];
                }
                #echo "cliente seleccionado:" . $select_cliente . "\n";
                $costoser=$_POST['costo'];
                $fachaActual = date("y")."-".date("m")."-".date("d");

                $sql='SELECT * FROM unidades WHERE noserie='.$select_unidad;
                    $result=mysqli_query($link,$sql);
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        $nomuni=$row['nomuni'];
                        $serie=$row['serie'];
                        $fecha_alta=$row['fecha_alta'];
                        $marca=$row['marca'];
                        $modelo=$row['modelo'];
                        $placas=$row['placas'];
                        $caja=$row['caja'];
                        $refrigeracion=$row['refrigeracion'];
                        $capacidadmac=$row['capasidad_max'];
                        $costo=$row['costo_adquisicion'];
                        $descripcion=$row['descripuni'];
                        $foto=$row['foto'];
                        $tipo=$row['tipo'];
                        $idsuc=$row['idsuc'];
                        
                    }
                    $sql='SELECT tipo FROM servicio WHERE id='.$select_servicio;
                    $result=mysqli_query($link,$sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $serv=$row['tipo'];
                    }
                    
                if($serv=='Apartado'){
                    $dipocision=4;
                    $costoser=0;
                    $edit_status=new consul();
                    $ediStatus=$edit_status->editarStatus($select_unidad,$nomuni,$serie,$fecha_alta,$marca,$modelo,$placas,$caja,$refrigeracion,$capacidadmac,$costo,$descripcion,$foto,$dipocision,$tipo,$idsuc,$fecha_final);
                    $add_unid=new consul();
                    $add=$add_unid->add_servicios($idc,$ids,$select_cliente,$select_servicio,$select_unidad,$fecha_inicial,$fecha_final,$timeI,$timeF,$select_transportar,$kilometraje,$monto_deposito,$valor_pagare,$direcol,$direntrega,$cddes,$timeR,$timeC,$costoser,$fachaActual);
                    $add_calendar=new consul();
                    $addcal=$add_calendar->add_calendario($serv,$fachaActual,$timeI,$select_unidad,$timeF,$fecha_inicial,$fecha_final,$select_servicio,$select_cliente,$ids);
                    $add_calendargen=new consul();
                    $addcal1=$add_calendargen->add_calendariogeneral($serv,$fachaActual,$select_unidad,$fecha_inicial,$fecha_final,$select_servicio,$select_cliente,$ids,$timeF);
                    
                }
                else{
                    $dipocision=3;
                    $edit_status=new consul();
                    $ediStatus=$edit_status->editarStatus($select_unidad,$nomuni,$serie,$fecha_alta,$marca,$modelo,$placas,$caja,$refrigeracion,$capacidadmac,$costo,$descripcion,$foto,$dipocision,$tipo,$idsuc,$fecha_final);
                    $add_unid=new consul();
                    $add=$add_unid->add_servicios($idc,$ids,$select_cliente,$select_servicio,$select_unidad,$fecha_inicial,$fecha_final,$timeI,$timeF,$select_transportar,$kilometraje,$monto_deposito,$valor_pagare,$direcol,$direntrega,$cddes,$timeR,$timeC,$costoser,$fachaActual);
                    $add_calendar=new consul();
                    $addcal=$add_calendar->add_calendario($serv,$fachaActual,$timeI,$select_unidad,$timeF,$fecha_inicial,$fecha_final,$select_servicio,$select_cliente,$ids);
                    $add_calendargen=new consul();
                    $addcal1=$add_calendargen->add_calendariogeneral($serv,$fachaActual,$select_unidad,$fecha_inicial,$fecha_final,$select_servicio,$select_cliente,$ids,$timeF);
                }
            }
}


?>