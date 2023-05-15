<?php
include ("../model/model_servicios.php");
include ("../model/liga_BD.php");
if($_POST['oper']=="mantenimientouni"){
    $idu=$_POST['idun'];
    $dispo=$_POST['disponibilidad'];
    $select_servicio=$_POST['idserv'];
    $ids=$_POST['idscur'];
    $descripcion=$_POST['descripcion'];
    $Inifecha=$_POST['Inifecha'];
    $fecha_final=$_POST['Finfecha'];
    $mante=$_POST['mantenimineto'];
    $gastos=$_POST['costomante'];

    $ff= "";
    $fi= "";
    $bandera= false;
    $fecha_inicial1= date("Y", strtotime("$Inifecha"));
    $fecha_inicialmes1= date("m", strtotime("$Inifecha"));
     //datos del POST AÑO Y MES DE FECHA FINAL
    $fecha_final1= date("Y", strtotime("$fecha_final"));
    $fecha_finalmes1= date("m", strtotime("$fecha_final"));
    //datos del CONSUTLA AÑO Y MES DE FECHA FINAL
    $fid2= date("d", strtotime("$Inifecha"));
    $ffd2= date("d", strtotime("$fecha_final"));
   
    if($dispo == "Si"){
        $sql="SELECT * FROM calendariogeneral WHERE iduni=$idu  and idserv=$select_servicio and idscr=$ids  and MONTH(fechaini) = $fecha_inicialmes1 AND YEAR(fechaini) = $fecha_inicial1 AND MONTH(fechafin) = $fecha_finalmes1 AND YEAR(fechafin) = $fecha_final1";
        $result=mysqli_query($link,$sql);
        while ($row1 = mysqli_fetch_assoc($result)) {
            $fi = $row1['fechaini'];
            $ff =$row1['fechafin'];

            $fiBD= date("d", strtotime("$fi"));
            $ffBD= date("d", strtotime("$ff"));
             //echo $ffd22;

            if($fiBD<=$fid2){
                if($ffBD<=$ffd2){
                    $bandera = true;
                    break;
                }
                else{
                    if($ffd2>=$fiBD) {
                        $bandera = true;
                        break;
                    }
                    else{
                        $bandera = false;
                        break;
                    }
                }
           
             }elseif ($fiBD >= $fid2) {
                if($ffBD >= $ffd2){
                    $bandera = true;
                    break;
                }
             }
             else{               
                $bandera = false;
                break; 
            }  
        }
    }
     if($bandera==true){
        //echo "dias ocupados Seleccione otras fechas";
         $dias=new consul();
         $diasOcupados=$dias->diasOcupados1($idu);
     }
     if($bandera==false){
        $sql='SELECT * FROM unidades WHERE noserie='.$idu;
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

        if($dispo=="Si"){
            $dispomant=2;
        }else{
            $dispomant=1;
        }
       
        $edit_status=new consul();
        $ediStatus=$edit_status->editarStatus($idu,$nomuni,$serie,$fecha_alta,$marca,$modelo,$placas,$caja,$refrigeracion,$capacidadmac,$costo,$descripcion,$foto,$dispomant,$tipo,$idsuc,$fecha_final);
        $fachaActual = date("y")."-".date("m")."-".date("d");
        $serv="Mantenimiento";
        $timeF="00:00:00";
        $timeI="00:00:00";
        $select_unidad= $idu;
        $fecha_inicial=$Inifecha; $fecha_final= $fecha_final;  $select_cliente=0;
        $add_calendar=new consul();
        $addcal=$add_calendar->add_calendario($serv,$fachaActual,$timeI,$select_unidad,$timeF,$fecha_inicial,$fecha_final,$select_servicio,$select_cliente,$ids);
        
        $add_calendargen=new consul();
        $addcal1=$add_calendargen->add_calendariogeneral($serv,$fachaActual,$select_unidad,$fecha_inicial,$fecha_final,$select_servicio,$select_cliente,$ids, $timeF);

        if($mante==="Mantenimiento No programado"){
            $otromante=$_POST['otromante'];
            
             $add_mant=new consul();
             $add=$add_mant->add_mantenimiento($mante,$Inifecha,$fecha_final,$dispo,$gastos,$otromante,$idu,$descripcion,$select_servicio,$ids);
         }else{
             
             $otromante=$_POST['mantProgramado'];
          
             $add_mant=new consul();
             $add=$add_mant->add_mantenimiento($mante,$Inifecha,$fecha_final,$dispo,$gastos,$otromante,$idu,$descripcion,$select_servicio,$ids);
         }
    }
}
?>