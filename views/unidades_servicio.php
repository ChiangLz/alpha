<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente

require_once("../model/unidades.php");
$col= new consul();
$col2= new consul();
$col3= new consul();
$col4= new consul();
$col5= new consul();
$nserie = $_GET['idu'];
$detalleUniId = $col->unidadesid($nserie);
$detalleCol = $col2->nomcolaborador($_SESSION['idc']);
$detalleSuc = $col3->nomsucursal($_SESSION['ids']);
$detalleunid = $col4->unidadesid($nserie);
$detallemantenimineto = $col5->manteniminetoidu($nserie);
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
              <div class="col-sm-6 col-md-4 text-center user_text"> <?php foreach ($detalleCol as $row2) { ?>
                <span class="gris_claro">Bienvenido:</span> <?php echo $row2['cuenta']; ?> 
                 </div>  
              <div class="col-sm-6 col-md-4 iconos_menu ">
                <div class="text-center">
                <a href="menus_cuadros.php"><i class="fas fa-th"></i></a>
                
              
                <a href="#"><i class="fas fa-question-circle"></i></a>                                  
                </div>
              </div>   
  </div>
  <div class="row ">
    <div class="d-flex flex-row">
      <div> 
        <div class="menu_lateral iconos_menu degradado ">
        <a href="unidades.php"><i class="fas fa-truck m-3 " data-toggle="tooltip" data-placement="right" title="Vehículos">
        </i></a>
        <a href="unidades_editar.php" ><i class="far fa-edit m-3" data-toggle="tooltip" data-placement="right" title="Editar"></i></a>
        <a href="unidades_editar.php" ><i class="far fa-plus-square m-3" data-toggle="tooltip" data-placement="right" title="Agregar"></i></a>
         
         <a href="unidades_calendario.php" ><i class="far fa-calendar m-3" data-toggle="tooltip" data-placement="right" title="Calendario"></i></a>
         <a href="unidades_baja.php" ><i class="fas fa-trash-alt m-3" data-toggle="tooltip" data-placement="right" title="Tirar"></i></a>
             
    </div>
  </div>
      
      <!--Segunda columna-->
      <div class=""> 
        <div class="contenedor_cabezal  border_seccion bg-white">
          <div class="float-right m-3"><a href="unidades.php"><i class="fas fa-chevron-left rojo_obscuro fa-2x"></i></a></div>
          <h1 class="text-center rojo_obscuro titulo_seccion mt-3">Servicios de la  Unidad </h1>
         <div class="text-white bg-dark box_circule rounded-circle m-2"> <i class="fas fa-truck m-3"></i></div>
         <?php foreach ($detalleUniId as $row) { ?>
          <h3 class="mt-4 rojo_obscuro"><?php echo $row['nomuni']; ?></h3>
        <?php  
         foreach ($detalleSuc as $row3) { ?>
        <h4 class="m-2"><?php echo $row3['nomsuc']; ?></h4>
        <?php } ?>


      </div>
      <div class="d-flex justify-content-between ">
          <div class="p-2 ">
            <img src="<?php echo $row['foto']; ?>" alt="transporte_imagen" class="img-fluid img-thumbnail mx-auto border-danger shadow" width="150px;">
            </div>
         <?php } ?>
            <div class="text-center rojo_obscuro m-2">
              <h4><i class="fas fa-oil-can m-3  fa-lg" data-placement="right" title="Mantenimiento"></i>Historico de Gasto</h4>
            </div>
            
            <div>
              <a href="unidades_calendario.php" type="button" class="btn btn-dark  m-3 rojo_obscuro_btn">
              <i class="far fa-calendar m-3"></i>
            Calendario</a>
            </div>
            <div>

              <?php if($row2['idrol']==3){
              foreach ($detalleunid as $row3) {  if($row3['iddispo']!=5){?>   
              <a href="unidades_servicio_editar.php?idu=<?php echo $row3['noserie']; ?>" type="button" class="btn btn-dark m-3 rojo_obscuro_btn">
              <i class="fas fa-oil-can m-3"></i>
                Agregar Gasto</a>

              <?php }} 

              }
              ?>
              </div>
          </div>

          <div class="d-flex flex-row p-2" style="height:400px; overflow-y:scroll;">
            <table class="table">
            <?php foreach ($detallemantenimineto as $rowm) { ?>
              <tr>
                <td class="font-weight-bold">Tipo:</td>
                <td  colspan="2" class="font-weight-bold rojo_obscuro text-left"><?php echo $rowm['tipo']; ?></td>
              </tr> 
               <tr>
                <td class="font-weight-bold">Afectación de disponibilidad:</td>
                <td  colspan="2" class="font-weight-bold rojo_obscuro text-left"><?php echo $rowm['afec_disponiilidad']; ?></td>
              </tr>
              <tr>
                <td class="font-weight-bold">Descripccion:</td>
                <td colspan="2" class="font-weight-bold rojo_obscuro text-left">  <?php echo $rowm['descripcion']; ?></td>
              </tr>
               <tr>
                <td class="font-weight-bold">Gasto:</td>
                <td  colspan="2"   class="font-weight-bold rojo_obscuro text-left"> $ <?php echo $rowm['gastos']; ?> </td>
              </tr>
              <tr>
                <td class="font-weight-bold">Fecha Inicial: <span class="rojo_obscuro"><?php echo $rowm['fecha_inicio']; ?></span></td>
                <td class="font-weight-bold ">Fecha Final: <span class="rojo_obscuro"><?php echo $rowm['fecha_final']; ?></span></td>
                <td class="font-weight-bold ">
                 </td>
              </tr>
              <tr  class="color_rojo_suave">
                <td colspan="3">&nbsp;</td>
              </tr>
              <?php } ?>
            </table>

            
          </div>
      


      <!-- termina seguda columna-->
      </div>
    

    </div>
   
 



    </div>
    <?php } ?>
</div>
  </div>
</div>       

  <script src="../content/js/jquery-3.3.1.min.js"></script>
  <script src="../content/js/bootstrap.min.js"></script>
  <script>
      const button = document.querySelector('#button');
      const tooltip = document.querySelector('#tooltip');

      Popper.createPopper(button, tooltip);


      $('#edit_detalles').click(function(){
      window.location = 'unidades_servicio_editar.html';
      });
    </script>
</body></html>
