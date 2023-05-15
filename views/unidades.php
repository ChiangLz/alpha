<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente
require_once("../model/unidades.php");

if($_SESSION['rol']==="SuperAdministrador"){
$col= new consul();
$col2= new consul();
$col3= new consul();
$detalleUni = $col->unidadesadm();
$detalleCol = $col2->nomcolaborador($_SESSION['idc']);
$detalleSuc = $col3->nomsucursaladm();

}else{
  $col= new consul();
  $col2= new consul();
  $col3= new consul();
  $detalleUni = $col->unidadessuc($_SESSION['ids']);
  $detalleCol = $col2->nomcolaborador($_SESSION['idc']);
  $detalleSuc = $col3->nomsucursal($_SESSION['ids']);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="icon_logo.gif">
    <title>Alfa Logistics MX 
  </title>

    <!-- Bootstrap core CSS -->
    <link async href="../content/css/bootstrap.css" rel="stylesheet">
    
    <link  async rel="stylesheet" href="../content/css/estilos.css">
    <!-- Custom Fonts -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <link rel="stylesheet" href="../content/js/popper.min.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  </head>
 
  <body>
  


  <!-- Content here -->          
<div class="container border border-secondary">
  <div class="row bg-dark">
              <div class="col-md-4 d-none d-md-block"><img src="../content/imagenes/logo.png" alt="IRIS" class="logo_iris"></div>
              <div class="col-sm-6 col-md-4 text-center user_text">
              <?php foreach ($detalleCol as $row2) { ?>
               <span class="gris_claro">Bienvenido:</span> <?php echo $row2['cuenta']; ?> </div>  
              
              <div class="col-sm-6 col-md-4 iconos_menu ">
                <div class="text-center">
                <a href="menus_cuadros.php"><i class="fas fa-th"></i></a>
                
             
                <a href="#"><i class="fas fa-question-circle"></i></a>    
                <a href="../model/cerrar.php"><i class="fas fa-user-times"></i></a>                               
                </div>
              </div>   
  </div>
  <div class="row bg-info">
    <div class="d-flex flex-row">
      <div> 
        <div class="menu_lateral iconos_menu degradado ">
        <a href="unidades.php"><i class="fas fa-truck m-3 " data-toggle="tooltip" data-placement="right" title="Vehículos">
        </i></a>
        <a href="unidades_editar.php" ><i class="far fa-edit m-3" data-toggle="tooltip" data-placement="right" title="Editar"></i></a>
        <a href="unidades_add.php" ><i class="far fa-plus-square m-3" data-toggle="tooltip" data-placement="right" title="Agregar"></i></a>
      
         <a href="unidades_calendario.php" ><i class="far fa-calendar m-3" data-toggle="tooltip" data-placement="right" title="Calendario"></i></a>
         <a href="unidades_baja.php" ><i class="fas fa-trash-alt m-3" data-toggle="tooltip" data-placement="right" title="Tirar"></i></a>
             
    </div>
  </div> 
      
      <!--Segunda columna-->
      <div class="bg-white"> 
        <div class="contenedor_cabezal  border_seccion">
        <h1 class="text-center rojo_obscuro titulo_seccion mt-3">Listado de Unidades </h1>
         <div class="d-flex m-2">
           <div class="text-white bg-dark box_circule rounded-circle m-2"> <i class="fas fa-truck m-3"></i></div>        
           <?php if($row2['idrol']!=1){ 
             foreach ($detalleSuc as $row3) { ?>
           <h4 class=" py-3"><?php echo $row3['nomsuc']; ?></h4>
           <?php }
          } ?>
         </div>
      </div>
      <div class="p-2">
        <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center"> NUMERACION DEL VEHÍCULO</th>
                  <th scope="col" class="text-center">FECHA DE ALTA</th>
                  <th scope="col" class="text-center" >DISPONIBILIDAD</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($detalleUni as $row) { ?>
                <tr class="color_rojo_suave">
                  <td class="text-center" >
                  <?php if($row2['idrol']==1){?>
                  <a href="unidades_detalle.php?ns=<?php echo $row['noserie']; ?>" class="rojo_obscuro"><i class="fas fa-eye" onclick="return false"></i></a>
                  <?php }else{?>
                    <a href="unidades_detalle.php?ns=<?php echo $row['noserie']; ?>" class="rojo_obscuro"><i class="fas fa-eye"></i></a>
                    <?php } ?>
                  </td>
                  
                  
                  <td class="text-center"  style="color:#660000"> <?php echo $row['nomuni']; ?> </td>
                  <td class="text-center"><?php echo $row['fecha_alta']; ?></td>
                  <td class="text-center">
                    <div class="row ">
                    <div class="col-md-3" >
                  </div>
                    <div class="col-md-6 ">
                  <?php 
                  if($row['iddispo']!=5){
                    /*Inicio */
                    $auxdisp=5;
                    $available= new consul();
                    $detail_available = $available->disponibilidad($row['idsuc'], $row['noserie']);
                    if (is_null($detail_available) or $detail_available['estado'] == 'finalizado') {
                      $auxdisp = 1;
                    }else{
                      if ($detail_available['idserv'] == 1 || $detail_available['idserv'] == 2) {
                        $auxdisp = 3;
                      }
                      if ($detail_available['idserv'] == 3) {
                        $auxdisp = 4;
                      }
                      if ($detail_available['idserv'] == 4) {
                        $auxdisp = 2;
                      }
                    }
                    /*fin*/
                    if($auxdisp==1){ ?>
                      <i class="fas fa-check-circle mr-2 text-success"></i> 
                  
                      <i class="fas fa-circle mr-2 text-warning"></i>  
                      <i class="fas fa-circle mr-2  text-danger"></i>
                      <?php if($auxdisp!=1){?>
                      <a class=" edit_uni1 " unidad="<?php echo $row['noserie']; ?>" fechaActividad="<?php echo $row['ultimaactividad']; ?>" style="cursor:pointer;"> <i class="fas fa-ban   text-danger"></i> </a>
                      <?php }} ?>
                    <?php if($auxdisp==2){ ?>
                      <i class="fas fa-circle mr-2 text-success"></i> 
                  
                      <i class="fas fa-check-circle mr-2 text-warning"></i>  
                      <i class="fas fa-circle  text-danger"></i>
                      <?php if($auxdisp!=1){?>
                      <a class=" edit_uni1 " unidad="<?php echo $row['noserie']; ?>" fechaActividad="<?php echo $row['ultimaactividad']; ?>" style="cursor:pointer;"> <i class="fas fa-ban   text-danger"></i> </a>
                      <?php }} ?> 
                    <?php if($auxdisp==3){ ?>
                      <i class="fas fa-circle mr-2 text-success"></i> 
                  
                      <i class="fas fa-circle mr-2 text-warning"></i>  
                      <i class="fas fa-check-circle   text-danger"></i>
                      <?php if($auxdisp!=1){?>
                      <a class=" edit_uni1 " unidad="<?php echo $row['noserie']; ?>" fechaActividad="<?php echo $row['ultimaactividad']; ?>" style="cursor:pointer;"> <i class="fas fa-ban   text-danger"></i> </a>
                      <?php }} 
                    }?> <!-- Colocado -->
                     
                    </div>


                   <?php if($row2['idrol']!=1){
                    if($row['ultimaactividad']!="0000-00-00"){
                   if(date("Y-m-d")>$row['ultimaactividad']){?> 
                      <div class="col-md-1" >
                          <a class=" edit_uni " unidad="<?php echo $row['noserie']; ?>"> <i class="fas fa-truck mt-1 rojo_obscuro "  title="Vehículos">
                        </i></a>
                       </div>
                    <?php }}}?>

                   </div>
                </td>
                </tr>
                <?php } ?>                
              </tbody>
            </table>


            
      </div>
      


      <!-- termina seguda columna-->
      </div>
      <?php } ?>

    </div>
   
 



    </div>
    



  






  </div>
  </div>
</div>       


      

   





  





<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="../content/js/funciones.js"></script>
  <!--<script src="js/jquery-3.3.1.min.js"></script>-->
  <script src="js/bootstrap.min.js"></script>
 




</body></html>  