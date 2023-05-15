<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente
require_once("../model/model_sucursal.php");
if($_SESSION['rol']==="SuperAdministrador"){
  $col= new consul();
  $col11= new consul();
  $detalleSuc = $col->sucursaladm1();
  $detalleSuc1 = $col11->sucursaladm2();
  $col1= new consul();
  $detalleCol = $col1->colaboradores($_SESSION['idc']);
}else{
  $col= new consul();
  $detalleSuc = $col->sucursal($_SESSION['ids']);
  $col1= new consul();
  $detalleCol = $col1->colaboradores($_SESSION['idc']);
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
    
    
  </head>
 
  <body>
  


  <!-- Content here -->          
<div class="container border border-secondary">
  <div class="row bg-dark">
              <div class="col-md-4 d-none d-md-block"><img src="../content/imagenes/logo.png" alt="IRIS" class="logo_iris"></div>
              <div class="col-sm-6 col-md-4 text-center user_text">
              <?php foreach ($detalleCol as $row) { ?>
                 <span class="gris_claro">Bienvenido:</span> <?php echo $row['cuenta']; ?>
                 
                </div>  
              <div class="col-sm-6 col-md-4 iconos_menu ">
                <div class="text-center">
                <a href="menus_cuadros.php"><i class="fas fa-th"></i></a>
               
               
                <a href="#"><i class="fas fa-question-circle"></i></a>  
                <a href="../model/cerrar.php"><i class="fas fa-user-times"></i></a>                                 
                </div>
              </div>   
  </div>
  <div class="row ">
    <div class="d-flex flex-row">
      <div> 
        <div class="menu_lateral iconos_menu degradado ">
        
    </div>
  </div>      
      <!--Segunda columna-->
      <div class=""> 
        <div class="contenedor_cabezal  border_seccion bg-white mb-2">
            <h1 class="text-center rojo_obscuro titulo_seccion mt-3 mb-2">Sucursales</h1>
        </div>


        <?php if($row['idrol']==1){ ?>

          <div class="d-flex justify-content-between p-3" >
            <?php foreach ($detalleSuc as $row1) { ?>
              
                <a href="sucursales_detalle.php?ids=<?php echo $row1['id']; ?>" style="color:#2F2C2B ">
                <div class="border rounded p-3 text-center box_sucursal m-3" >
                
                
                  <i class="fas fa-building fa-4x m-3 rojo_obscuro"></i>
                  <p class="font-weight-bold h5">Sucursal <br> <?php echo $row1['nomsuc']; ?></p> <br>
                  <p class="font-weight-bold "><?php echo $row1['dirsuc']; ?></p>   
                          
                </div>
                </a>
                
            <?php } ?>
        </div>
        <div class="d-flex justify-content-center  p-3">
        <?php foreach ($detalleSuc1 as $row11) { ?>
          <a href="sucursales_detalle.php?ids=<?php echo $row11['id']; ?>" style="color:#2F2C2B ">
                <div class="border rounded p-3 text-center box_sucursal m-3" >
                
                
                  <i class="fas fa-building fa-4x m-3 rojo_obscuro"></i>
                  <p class="font-weight-bold h5">Sucursal <br> <?php echo $row11['nomsuc']; ?></p> <br>
                  <p class="font-weight-bold "><?php echo $row11['dirsuc']; ?></p>   
                          
                </div>
                </a>
                
          
          
       <?php }?>
       </div>
       <?php } else{ foreach ($detalleSuc as $row1) { ?>

          <div class="d-flex justify-content-center  p-3">
          <a href="sucursales_detalle.php" style="color:#2F2C2B ">
            <div class="border rounded p-3 text-center box_sucursal m-3" >
            
            
              <i class="fas fa-building fa-4x m-3 rojo_obscuro"></i>
              <p class="font-weight-bold h5">Sucursal <br> <?php echo $row1['nomsuc']; ?></p> <br>
              <p class="font-weight-bold "><?php echo $row1['dirsuc']; ?></p>   
                       
            </div>
            </a>       
      </div>
  
        <?php }}?>
            
     
        <!-- <div class="d-flex justify-content-center  p-3">
            <div class="border rounded p-3 text-center box_sucursal m-3" >
              <i class="fas fa-building fa-4x m-3 rojo_obscuro"></i>
              <p class="font-weight-bold h5">Sucursal <br> Los Reyes la Paz</p> <br>
              <p class="font-weight-bold ">Av. Salvador Díaz Mirón #325</p>            
            </div>

            <div class="border rounded p-3 text-center box_sucursal m-3" >
              <i class="fas fa-building fa-4x m-3 rojo_obscuro"></i>
              <p class="font-weight-bold h5">Sucursal <br> Los Reyes la Paz</p> <br>
              <p class="font-weight-bold ">Av. Salvador Díaz Mirón #325</p>            
            </div>

              
      </div>-->

    
   <!-- termina seguda columna-->
    </div>
   
 



    </div>
    <?php } ?>
</div>
  </div>
</div>       

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
     $('#sucursal1').click(function(){
         
        window.location = 'sucursales_detalle.php';
      });
  </script>
 
</body></html>
<!-- Modal -->
