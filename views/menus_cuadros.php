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