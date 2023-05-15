<?php
require_once("../model/unidades.php");
if($_POST['consutla']=="atras"){

   /* $ids = $_POST['ids'];
    $mesactual = $_POST['valor'];*/
    
   $col3= new consul();
    $detalleSuc = $col3->nomsucursal($_POST['ids']);
    


   $mes = array(1=>31, 2=>28, 3=>31, 4=>30, 5=>31, 6=>30, 7=>31, 8=>31, 9=>30, 10=>31, 11=>30, 12=>31);
    $mesactual = $_POST['valor'];
    foreach($mes as $posicion=>$dias){
        if($posicion==$mesactual){
          for ($i = 1; $i <= $dias; $i++) {
            $bandera=true;
            $valorfechaIni="";
            $valorfechaFin="";
      
            if(empty ($detalleFecha)){
              echo '<div class="box_calendario ">'.$i.'</div> ';
      
            }else{
              foreach ($detalleFecha as $rowf) { 
         
                $valorfechaIni= $rowf['fechaini'];
                $diaini = date("d", strtotime("$valorfechaIni"));
                $valorfechaFin= $rowf['fechafin'];
                $diafin = date("d", strtotime("$valorfechaFin"));
                
        
                 if($diaini==$i || $diafin==$i){
                   $bandera=true; break;
                   $valorfechaIni=$rowf['fechaini'];
                   $valorfechaFin= $rowf['fechafin'];
                 }else {
                  $bandera=false;
                 
                 }
               }
      
               if($bandera==true){
                if($rowf['fechaini']==$rowf['fechaini']){
                 echo '<a href="calendario_detalle.php?fecha='.$valorfechaIni.'"><div class="box_calendario box_calendario_ocupado"  >';
                 if($rowf['idserv']==3 && $rowf['idserv']==1 || $rowf['idserv']==3 && $rowf['idserv']==2){
                   echo' <div class="rounded-circle circulo_rojo"></div>';
                   echo '<div class="rounded-circle circulo_amarillo"></div>';
                             
                 }
                 
                
                echo $i.'</div> </a>';
                }else{
                 echo '<a href="calendario_detalle.php?fecha='.$valorfechaFin.'"><div class="box_calendario box_calendario_ocupado"  >'.$i.' </div> </a>';
                }
             
             // echo '<div class="box_calendario box_calendario_ocupado"  >'.$i.' <a href="calendario_detalle.php?fecha='. $valorfecha.'">liga</a> </div> ';
              
              
             }else {
            
              echo '<div class="box_calendario" >'.$i.'</div> ';
             }
            }
            
             
      
              
      
            
          }
        }
      }

}

?>