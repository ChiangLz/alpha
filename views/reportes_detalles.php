<?php 
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente
require_once("../model/reportes.php");
$idr=$_GET['idr'];

$col= new consul();
$detalleCol = $col->nomcolaborador($_SESSION['idc']);
$col1= new consul();
$detalleReport = $col1->reportes_sucursalesid($idr);

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
    
  </head>
 
  <body>
  


  <!-- Content here -->          
<div class="container border border-secondary">
  <div class="row bg-dark">
              <div class="col-md-4 d-none d-md-block"><img src="../content/imagenes/logo.png" alt="IRIS" class="logo_iris"></div>
              <div class="col-sm-6 col-md-4 text-center user_text">
              <?php foreach ($detalleCol as $row2) { ?>  
              <span class="gris_claro">Bienvenido:</span><?php echo $row2['cuenta']; ?>  </div>  
              <?php }?>
              <div class="col-sm-6 col-md-4 iconos_menu ">
                <div class="text-center">
                <a href="menus_cuadros.php"><i class="fas fa-th"></i></a>
              
              
                <a href="#"><i class="fas fa-question-circle"></i></a>                                  
                </div>
              </div>   
  </div>
  <div class="row bg-info">
    <div class="d-flex flex-row">
      <div> 
        <div class="menu_lateral iconos_menu degradado">
        <a href="reportes.php"><i class="far fa-file m-3" data-toggle="tooltip" data-placement="right" title="Reportes">
        </i></a>
       <!-- <a href="#" ><i class="far fa-edit m-3" data-toggle="tooltip" data-placement="right" title="Editar"></i></a>
        <a href="#" ><i class="far fa-plus-square m-3" data-toggle="tooltip" data-placement="right" title="Agregar"></i></a>
         
         <a href="#" ><i class="far fa-calendar m-3" data-toggle="tooltip" data-placement="right" title="Calendario"></i></a>
        <a href="#" ><i class="fas fa-trash-alt m-3" data-toggle="tooltip" data-placement="right" title="Tirar"></i></a> -->
             
    </div>
  </div> 
      
      <!--Segunda columna-->
      <div class="bg-white"> 
        <div class="contenedor_cabezal  border_seccion">
        <h1 class="text-center rojo_obscuro titulo_seccion mt-3">Listado de Reportes </h1>
         <div class="d-flex m-2">
           <div class="text-white bg-dark box_circule rounded-circle m-2"> <i class="far fa-file m-4"></i></div>        
           <?php foreach ($detalleReport as $rowr) { ?> 
           <h4 class=" py-3">Reporte de <?php echo $rowr['tipo']; ?></h4>
         </div>
      </div>
      <div class="p-2">
       <table class="table">
              <tbody>
              <?php }foreach ($detalleReport as $rowr) { ?> 
                <tr>
                <td class="font-weight-bold">Tipo:  </td>
                <td colspan="2" class="font-weight-bold rojo_obscuro text-left"><?php echo $rowr['tipo']; ?></td>
              </tr> 
               <tr>
                <td class="font-weight-bold">Disponibilidad:</td>
                <td colspan="2" class="font-weight-bold rojo_obscuro text-left"><?php echo $rowr['nomdispo']; ?></td>
              </tr>
              <tr>
                <td class="font-weight-bold">Descripccion del  Mantenimiento:</td>
                <td colspan="2" class="font-weight-bold rojo_obscuro text-left"><?php echo $rowr['tipo']; ?> de la unidad <?php echo $rowr['nomuni']; ?> <br> para el transporte de <?php echo $rowr['marcandia_transportar']; ?></td>
              </tr>
               <tr>
                <td class="font-weight-bold">Gasto:</td>
                <td colspan="2" class="font-weight-bold rojo_obscuro text-left"> $ <?php echo $rowr['costo']; ?> </td>
              </tr>
              <tr>
                <td class="font-weight-bold">Fecha Inicial: <span class="rojo_obscuro"><?php echo $rowr['fecha_inicial']; ?></span></td>
                <td class="font-weight-bold ">Fecha Final: <span class="rojo_obscuro"><?php echo $rowr['fecha_final']; ?></span></td>
                <td class="font-weight-bold ">
                 </td>
              </tr>
              <tr class="color_rojo_suave">
                <td colspan="3">&nbsp;</td>
              </tr>
              <?php }?>
             
            </tbody></table>

            
      </div>
      


      <!-- termina seguda columna-->
      </div>
    

    </div>
   
 



    </div>
    



  






  </div>
  </div>
</div>       



      

   





  






 
  <script src="../content/js/jquery-3.3.1.min.js"></script>
  <script src="../content/js/bootstrap.min.js"></script>
  <script>
      const button = document.querySelector('#button');
      const tooltip = document.querySelector('#tooltip');

      Popper.createPopper(button, tooltip);
    </script>




</body></html>  