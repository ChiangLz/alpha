<?php
require_once("../model/unidades.php");
session_start();
setlocale(LC_ALL,"es_ES");

if($_POST['consulta']=="atras"){
    $col6= new consul();
    $m = intval($_POST['valor']);
    $anio = date("Y");
    $fa = ($_POST['fechaActual']);
    $detalleFecha = $col6->fecha_cal($_SESSION['ids'], $m);
    $mes = array(1=>31, 2=>28, 3=>31, 4=>30, 5=>31, 6=>30, 7=>31, 8=>31, 9=>30, 10=>31, 11=>30, 12=>31);
    $nombreDia = array(1=>"Lunes", 2=>"Martes",3=>"Miercoles", 4=>"Jueves",5=>"Viernes", 6=>"Sábado",7=>"Domingo");
    $mesactual = date ("m");

 

    $j= $_SESSION["diaMes"][$m];//contador del nombre del dia inicial el mes 
 
    foreach($mes as $posicion=>$dias){
         //condiciones para verificar que los contadores atrás y adelante regresen a 12 y 1 los contadores back y next
        if($posicion==$m){
            
            if($m==12){
                $next=1;
              
            }else{
                $next=$m+1;
            }
            if($m==1){
                $back=12;
            }else{
                $back=$m-1;
            }
            //se guarda el número del dia que inicia el mes anterior al actual
            $_SESSION["diaMes"][$back]=calcularDiasMesAnterior($mes[$back],$j); 

            if($m < 10){
                $m = '0'.$m;
            }      
            for ($i = 1; $i <= $dias; $i++) {
                $bandera=true;           
                if($j>7)  $j=1; // condición para reiniciar el nombre cada 7 dias
                    //si esta vacio
                if(empty ($detalleFecha)){
                //imprime los recuadros del calendario
                    echo '<div class="box_calendario ">'.$i. '<p> '.$nombreDia[$j].'</p></div> ';
                }else{
                    foreach ($detalleFecha as $rowf) {
                        $valorfechaIni= $rowf['fechaini'];
                        $status= $rowf['estado'];
                        $anioini1 = date("Y", strtotime("$valorfechaIni"));
                        if($status != "finalizado"){
                        #echo intval($anioini1)."==".intval($_POST['fechaActual']);
                            if(intval($anioini1)== intval($_POST['fechaActual'])){
                                //$valorfechaIni= $rowf['fechaini'];
                                $diaini = date("d", strtotime("$valorfechaIni"));
                                $mesin = date("m", strtotime("$valorfechaIni"));
                                $valorfechaFin= $rowf['fechafin'];
                                $diafin = date("d", strtotime("$valorfechaFin"));
                                $mesfin = date("m", strtotime("$valorfechaFin"));
                                #echo $m." > ".$mesin ." and". $m ."<".$mesfin;
                                if($m > $mesin and $m < $mesfin){
                                    $bandera=true; 
                                        $diaini1 = date("Y-m", strtotime("$valorfechaIni"));
                                        if($i<10){
                                        
                                            echo '<a href="calendario_detalle.php?fechaDatos='.$anio.'-'.$m.'-0'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                            <div class="box_calendario';
                                            echo ' box_calendario_ocupado" >'.$i. '<p> '.$nombreDia[$j].'</p></div> </a>';
                                        }
                                        else{
                                            
                                            echo '<a href="calendario_detalle.php?fechaDatos='.$anio.'-'.$m.'-'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                            <div class="box_calendario';
                                            echo' box_calendario_ocupado">'.$i. '<p> '.$nombreDia[$j].'</p></div> </a>';
                                        }
                                        
                                        break;
                                }
                                #echo $i.">=".$diaini. "&&". $i."<=".$diafin;
                                if($diaini > $diafin AND $mesactual == $m){
                                    if($i>=$diaini){
                                        $bandera=true; 
                                        $diaini1 = date("Y-m", strtotime("$valorfechaIni"));
                                        if($i<10){
                                        
                                            echo '<a href="calendario_detalle.php?fechaDatos='.$anio.'-'.$m.'-0'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                            <div class="box_calendario';
                                            echo ' box_calendario_ocupado" >'.$i. '<p> '.$nombreDia[$j].'</p></div> </a>';
                                        }
                                        else{
                                            
                                            echo '<a href="calendario_detalle.php?fechaDatos='.$anio.'-'.$m.'-'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                            <div class="box_calendario';
                                            echo' box_calendario_ocupado">'.$i. '<p> '.$nombreDia[$j].'</p></div> </a>';
                                        }
                                        
                                        break;
                                    }
                                }
                                #echo $diaini." > ".$diafin . " AND ".$mesactual." > ".$m;
                                if($diaini > $diafin AND $mesactual > $m){
                                    #echo $i.">=".$diaini;
                                    if($i>=$diaini){
                                        $bandera=true; 
                                    $diaini1 = date("Y-m", strtotime("$valorfechaIni"));
                                    if($i<10){
                                    
                                        echo '<a href="calendario_detalle.php?fechaDatos='.$anio.'-'.$m.'-0'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                        <div class="box_calendario';
                                        echo ' box_calendario_ocupado" >'.$i. '<p> '.$nombreDia[$j].'</p></div> </a>';
                                    }
                                    else{
                                        
                                        echo '<a href="calendario_detalle.php?fechaDatos='.$anio.'-'.$m.'-'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                        <div class="box_calendario';
                                        echo' box_calendario_ocupado">'.$i. '<p> '.$nombreDia[$j].'</p></div> </a>';
                                    }
                                    
                                    break;
                                    }
                                }
                                if($diaini > $diafin AND $mesactual < $m){
                                    if($i<=$diafin){
                                        $bandera=true; 
                                    $diaini1 = date("Y-m", strtotime("$valorfechaIni"));
                                    if($i<10){
                                    
                                        echo '<a href="calendario_detalle.php?fechaDatos='.$anio.'-'.$m.'-0'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                        <div class="box_calendario';
                                        echo ' box_calendario_ocupado" >'.$i. '<p> '.$nombreDia[$j].'</p></div> </a>';
                                    }
                                    else{
                                        
                                        echo '<a href="calendario_detalle.php?fechaDatos='.$anio.'-'.$m.'-'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                        <div class="box_calendario';
                                        echo' box_calendario_ocupado">'.$i. '<p> '.$nombreDia[$j].'</p></div> </a>';
                                    }
                                    
                                    break;
                                    }
                                }
                                if($i>=$diaini && $i<=$diafin){
                                    
                                    $bandera=true; 
                                    $diaini1 = date("Y-m", strtotime("$valorfechaIni"));
                                    if($i<10){
                                    
                                        echo '<a href="calendario_detalle.php?fechaDatos='.$anio.'-'.$m.'-0'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                        <div class="box_calendario';
                                        echo ' box_calendario_ocupado" >'.$i. '<p> '.$nombreDia[$j].'</p></div> </a>';
                                    }
                                    else{
                                        
                                        echo '<a href="calendario_detalle.php?fechaDatos='.$anio.'-'.$m.'-'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                        <div class="box_calendario';
                                        echo' box_calendario_ocupado">'.$i. '<p> '.$nombreDia[$j].'</p></div> </a>';
                                    }
                                    
                                    break;
                                }else {
                                    $bandera=false;
                                }
                            }else{
                                $bandera=false;
                            }
                        }else{
                            $bandera=false;
                        }
                
                
                    }
                    if($bandera==false){
                        echo '<div class="box_calendario" >'.$i. '<p> '.$nombreDia[$j].'</p></div>';
                    }

           

                }
                $j=$j+1; //contador para aumentar el número del dia 
            }
            
      
            $_SESSION["diaMes"][$next]=$j; 
     
    
    
  
        
        }
     
    }

}

//función para calcular que numero de dia inicia el mes anterior, apartir del dia final de ese mes
function calcularDiasMesAnterior($diasmA,$j) {
    $a=$j-1;
  
    for ($i = 1; $i <$diasmA; $i++) {
        if($a<1)  $a=7; // condición para reiniciar el nombre cada 7 dias
            $a=$a-1;
    }
  

    if($a==0)$a=7;//por el decremento es 0 entonces inicia a 7
    return $a;

}