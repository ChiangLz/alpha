<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente
require_once("../model/model_sucursal.php");
if($_SESSION['rol']==="SuperAdministrador"){
  $col= new consul();
  $col11= new consul();
  $detalleSuc = $col->sucursaladm1();
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
                <?php if($_SESSION['rol']==="SuperAdministrador"){ ?>
                    <a href="add_sucursal.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-building-fill-add" viewBox="0 0 16 16">
                      <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Z"/>
                      <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v7.256A4.493 4.493 0 0 0 12.5 8a4.493 4.493 0 0 0-3.59 1.787A.498.498 0 0 0 9 9.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .39-.187A4.476 4.476 0 0 0 8.027 12H6.5a.5.5 0 0 0-.5.5V16H3a1 1 0 0 1-1-1V1Zm2 1.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5Zm3 0v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1ZM4 5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5ZM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5ZM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z"/>
                    </svg>
                    </a>
                  <?php } ?>
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

            <?php 
              $cont=0;
              foreach ($detalleSuc as $row1) { 
                if($cont==0){
                  echo '<div class="d-flex justify-content-between p-3">';
                }
              ?>
                <a href="sucursales_detalle.php?ids=<?php echo $row1['id']; ?>" style="color:#2F2C2B ">
                <div class="border rounded p-3 text-center box_sucursal m-3" style="min-width: 20em;">
                
                  <i class="fas fa-building fa-4x m-3 rojo_obscuro"></i>
                  <p class="font-weight-bold h5">Sucursal <br> <?php echo $row1['nomsuc']; ?></p> <br>
                  <p class="font-weight-bold "><?php echo $row1['dirsuc']; ?></p>   
                          
                </div>
                </a>
                <?php 
                $cont++;
                if($cont==3){
                  echo '</div>';
                  $cont=0;
                }
              }
        } else{
        foreach ($detalleSuc as $row1) { ?>

          <div class="d-flex justify-content-center  p-3">
          <a href="sucursales_detalle.php" style="color:#2F2C2B ">
            <div class="border rounded p-3 text-center box_sucursal m-3" >
            
            
              <i class="fas fa-building fa-4x m-3 rojo_obscuro"></i>
              <p class="font-weight-bold h5">Sucursal <br> <?php echo $row1['nomsuc']; ?></p> <br>
              <p class="font-weight-bold "><?php echo $row1['dirsuc']; ?></p>   
                       
            </div>
            </a>       
      </div>
  
      <?php 
      }} ?>
            
     
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
