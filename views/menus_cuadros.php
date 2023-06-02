<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente
require_once("../model/model_menu.php");
$col= new consul();
$detalleCol = $col->nomcol($_SESSION['idc']);
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
    
    <style>
     li{
      list-style:none;
     }
    </style>
  </head>
 
  <body class="degradado">

  


  <!-- Content here -->


          
<div class="container  bg-dark">
   <div class="row">
              <div class="col-md-4 d-none d-md-block"><img src="../content/imagenes/logo.png" alt="IRIS" class="logo_iris"></div>
              <div class="col-sm-6 col-md-4 text-center user_text"> 
                <?php foreach ($detalleCol as $row) { ?>
                  <span class="gris_claro">Bienvenido:</span> <?php echo $row['cuenta']; ?> 
                  <?php } ?>
                </div>  

              <div class="col-sm-6 col-md-4 iconos_menu ">
                <div class="text-center">
                <?php foreach ($detalleCol as $row) { 
                  if($row['idrol'] == 1){ ?>
                    <a href="list_users.php">
                      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                      </svg>
                    </a>
                    <a href="add_users.php">
                      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
                      </svg>
                    </a>
                  <?php }
                } ?>
                <a href=""><i class="fas fa-th"></i></a>
                <a href="#"><i class="fas fa-question-circle"></i></a>
                <a href="../model/cerrar.php"><i class="fas fa-user-times"></i></a>                                  
                </div>
              </div>   
  </div> 
</div>
<div class="container border border-light">
  <div class="row mt-5 mb-3">
    <div class="col-md-4">
      <ul class="ul">
        <li class="li">
          <a href="unidades.php" class="menuLink">
            <div class="cuadros_menus mx-auto">
              <div class="contendor_titulo">Unidades </div> 
            <i class="fas fa-truck m-3 icono_zona"></i>  
            </div>
          </a>
        </li>
    </div>
    <div class="col-md-4">
      <li>
        <a href="clientes.php?" class="menuLink">
          <div class="cuadros_menus mx-auto">
            <div class="contendor_titulo">Clientes</div> 
          <i class="fas fa-suitcase  m-3 icono_zona"></i>
          </div>
        </a>
      </li>
    </div>
    <div class="col-md-4">
      <li>
        <a href="servicios.php?" class="menuLink">
          <div class="cuadros_menus mx-auto">
            <div class="contendor_titulo">Servicios</div> 
          <i class="fas fa-dollar-sign m-3 icono_zona"></i>
          </div>
        </a>
      </li>
    </ul>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-md-4">
      <ul>
        <li>
          <a href="reportes.php?" class="menuLink">
            <div class="cuadros_menus mx-auto">
              <div class="contendor_titulo">Reporte</div> 
              <i class="far fa-file m-3 icono_zona"></i>
              </div>
          </a>
        </li>
    </div>
    <div class="col-md-4">
      <li>
        <a href="sucursales.php?" class="menuLink">
          <div class="cuadros_menus mx-auto">
            <div class="contendor_titulo">Sucursales</div> 
            <i class="fas fa-building m-3 icono_zona"></i>
          </div>
        </a>
      </li>
    </div> 
    <div class="col-md-4">
      <li>
        <a href="unidades_calendario.php?" class="menuLink">
          <div class="cuadros_menus mx-auto">
            <div class="contendor_titulo">Calendario</div> 
            <i class="far fa-calendar m-3 icono_zona"></i>
          </div>
        </a>
      </li>
    </ul>
    </div>
  </div>
</div>

</body></html>  