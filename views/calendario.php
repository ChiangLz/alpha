<?php
require_once("../model/unidades.php");
session_start();
setlocale(LC_ALL,"es_ES");


if($_POST["consulta"]=="calendar"){
    $col6= new consul();
    $mesactual = date ("m");
    $detalleFecha = $col6->fecha_cal($_SESSION['ids'], $mesactual);
    $mes = array(1=>31, 2=>28, 3=>31, 4=>30, 5=>31, 6=>30, 7=>31, 8=>31, 9=>30, 10=>31, 11=>30, 12=>31);
    $nombreDia= array(1=>"Lunes", 2=>"Martes",3=>"Miercoles", 4=>"Jueves",5=>"Viernes", 6=>"Sábado",7=>"Domingo");
    
    
    $fecha='Y-m-01';//obtener el dia que inicia el mes actual
    $j= (date('N', strtotime($fecha)))+1;//obtiene el número del dia que inicia el mes actual para contar cada 7 dias
    

    foreach($mes as $posicion=>$dias){
        //condiciones para verificar que los contadores atrás y adelante regresen a 12 y 1
        if($posicion==$mesactual){
            
            if($mesactual==12){
                $next=1;
              
            }else{
                $next=$mesactual+1;
            }
            if($mesactual==1){
                $back=12;
            }else{
                $back=$mesactual-1;
            }
       
            //se guarda el número del dia que inicia el mes anterior a este
            $_SESSION["diaMes"][$back]=calcularDiasMesAnterior($mes[$back],$j); 
   



            for ($i = 1; $i <= $dias; $i++) {
                if($j>7)  $j=1; // condición para reiniciar el número cada 7 dias
                $bandera=true;
            
                //si esta vacio
                if(empty ($detalleFecha)){
                    //imprime los recuadros del calendario
                    echo '<div class="box_calendario ">'.$i. '<p> '.$nombreDia[$j].'</p></div> ';

                }else{
                    foreach ($detalleFecha as $rowf) {
                        $valorfechaIni= $rowf['fechaini'];
                        $valorfechaFin= $rowf['fechafin'];
                        $status= $rowf['estado'];
                        $anioini1 = date("Y", strtotime("$valorfechaIni"));
                        if($status != "finalizado"){
                            $m = date("m");
                            #echo intval($anioini1)."==".intval($_POST['fechaActual']);
                            if(intval($anioini1)== intval($_POST['fechaActual'])){
                                //$valorfechaIni= $rowf['fechaini'];
                                $diaini = date("d", strtotime("$valorfechaIni"));
                                $diafin = date("d", strtotime("$valorfechaFin"));
                                $mesini = date("m", strtotime("$valorfechaIni"));
                                $mesfin = date("m", strtotime("$valorfechaFin"));
                                $diaini1 = date("Y-m");
                                
                                #echo $diaini1;
                                if($m > $mesini && $m < $mesfin){
                                    $bandera = true;
                                    if($i<10){
                                        echo '<a href="calendario_detalle.php?fechaDatos='.$diaini1.'-0'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                        <div class="box_calendario';
                                        echo' box_calendario_ocupado">'.$i. '<p> '.$nombreDia[$j].'</p></div> </a>';
                                    }
                                    else{
                                        
                                        echo '<a href="calendario_detalle.php?fechaDatos='.$diaini1.'-'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                        <div class="box_calendario';
                                        echo' box_calendario_ocupado">'.$i. '<p> '.$nombreDia[$j].'</p></div> </a>';
                                    }
                                    break;
                                }else{
                                    $bandera = false;
                                }
                                if($m == $mesini && $m == $mesfin){
                                    if($i >= $diaini && $i <= $diafin){
                                        $bandera = true;
                                        if($i<10){
                                            echo '<a href="calendario_detalle.php?fechaDatos='.$diaini1.'-0'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                            <div class="box_calendario';
                                            echo' box_calendario_ocupado">'.$i. '<p> '.$nombreDia[$j].'</p></div> </a>';
                                        }
                                        else{
                                            
                                            echo '<a href="calendario_detalle.php?fechaDatos='.$diaini1.'-'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                            <div class="box_calendario';
                                            echo' box_calendario_ocupado">'.$i. '<p> '.$nombreDia[$j].'</p></div> </a>';
                                        }
                                        break;
                                    }
                                }else{
                                    $bandera = false;
                                }
                                if($m == $mesini && $mesfin > $m){
                                    if($i >= $diaini){
                                        $bandera = true;
                                        if($i<10){
                                            echo '<a href="calendario_detalle.php?fechaDatos='.$diaini1.'-0'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                            <div class="box_calendario';
                                            echo' box_calendario_ocupado">'.$i. '<p> '.$nombreDia[$j].'</p></div> </a>';
                                        }
                                        else{
                                            
                                            echo '<a href="calendario_detalle.php?fechaDatos='.$diaini1.'-'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                            <div class="box_calendario';
                                            echo' box_calendario_ocupado">'.$i. '<p> '.$nombreDia[$j].'</p></div> </a>';
                                        }
                                        break;
                                    }
                                }else{
                                    $bandera = false;
                                }
                                if($mesini < $m && $m == $mesfin){
                                    if($i >= $diaini){
                                        $bandera = true;
                                        if($i<10){
                                            echo '<a href="calendario_detalle.php?fechaDatos='.$diaini1.'-0'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                            <div class="box_calendario';
                                            echo' box_calendario_ocupado">'.$i. '<p> '.$nameD[$j].'</p></div> </a>';
                                        }
                                        else{
                                            
                                            echo '<a href="calendario_detalle.php?fechaDatos='.$diaini1.'-'.$i.'&fecha='. $valorfechaIni.'&estado='.$status.'">
                                            <div class="box_calendario';
                                            echo' box_calendario_ocupado">'.$i. '<p> '.$$nombreDia[$j].'</p></div> </a>';
                                        }
                                        break;
                                    }
                                }else{
                                    $bandera = false;
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

               $j=$j+1; //contador para aumentar el numero del dia 
       
            
    
            
            }
            
            
        }
    }  
    //guarda el numero del dia que inicia el siguiente mes al actual
    $_SESSION["diaMes"][$next]=$j; 
     
   
}
//función para calcular que numero de dia inicia el mes anterior, apartir del dia final de ese mes
function calcularDiasMesAnterior($diasmA,$j) {
   
    $a=$j-1;  
    for ($i = 1; $i <$diasmA; $i++) {
        if($a<1)  $a=7; // condición para reiniciar el nombre cada 7 dias
            $a=$a-1;
    }
  
    if($a==0)$a=7;//por si el contador termina en 0 significa que es el 7 dia domingo
    return $a;

  


}

?>