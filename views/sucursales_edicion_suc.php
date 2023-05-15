<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente

require_once("../model/model_sucursal.php");
$idsuc = $_GET['id'];
$col= new consul();
$detallecolsuc = $col->sucursal($idsuc);
$col1= new consul();
$col2= new consul();
$detalleCol = $col1->colaboradores($_SESSION['idc']);
$detallerepresen = $col2->representante($idsuc);
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
        <?php if($row['idrol']==1){  foreach ($detallecolsuc as $row3){?>
         <a href="sucursales_detalle.php?ids=<?php echo $row3['id']; ?>"><i class="fas fa-building m-3 " data-toggle="tooltip" data-placement="right" title="Sucursales">
        </i>
        </a>
        <?php }}else{?> 
          <a href="sucursales_detalle.php"><i class="fas fa-building m-3 " data-toggle="tooltip" data-placement="right" title="Sucursales">
        </i>
        </a>
        <?php }?>
    </div>
  </div>      
      <!--Segunda columna-->
      <div class=""> 
        <div class="contenedor_cabezal  border_seccion bg-white mb-2">          
          <h1 class="text-center rojo_obscuro titulo_seccion mt-3 mb-2">Sucursales Edición de Sucursal</h1>    
      </div>
      
      <form  action="../controller/add_sucursal.php" method="post" enctype="multipart/form-data">
        <div class="d-flex justify-content-center  p-3">
            <div class="border rounded p-3 text-center box_sucursal m-3">
              <i class="fas fa-building fa-4x m-3 rojo_obscuro"></i>
              <?php foreach ($detallecolsuc as $row3) { ?>
              <input hidden type="text" id="id" name="id" value="<?php echo $row3['id']; ?>">
              <p class=" h5"> Editar Sucursal:
               <input type="text"  class="form-control" id="nom" name="nom" value="<?php echo $row3['nomsuc']; ?>" style="width:400px"> </p> <br>
              <p class="font-weight-bold ">Editar Dirección:
              <input type="text" class="form-control" id="dir" name="dir" value="<?php echo $row3['dirsuc']; ?>" style="width:400px; "></p>
              <p class="font-weight-bold "> 
               Editar Teléfono: 
               <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $row3['telsuc']; ?>" style="width:400px; "> 
            </p>
            <p class="font-weight-bold "> 
               Editar CP: 
               <input type="text" class="form-control" id="cp" name="cp" value="<?php echo $row3['cp']; ?>" style="width:400px; "> 
            </p>
            <p class="font-weight-bold "> 
               Editar Estado: 
               <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $row3['estado']; ?>" style="width:400px; "> 
            </p>
            <?php } ?> 
            <div class="d-flex justify-content-center">
            <?php if($row['idrol']==1){  foreach ($detallecolsuc as $row3){?>
              <a href="sucursales_detalle.php?ids=<?php echo $row3['id']; ?>" type="button" class="btn btn-dark  m-3">
              Cancelar Cambios</a>

              <?php }}?>
              <button type="submit" name="edit_sucursal" class="btn btn-dark  m-3 rojo_obscuro_btn" value="Guardar datos">
           <!-- <button type="button" class="btn btn-dark btn-lg m-3" data-toggle="modal" data-target="#guardar_cambios">-->
            Guardar Cambios
          </button>
            </div>
        </div>
    </div>
    </form>
    <div class="d-flex rojo_obscuro_btn text-white justify-content-center">
      <div><p class="text-center h4">Listado de Representante Legal</p></div>
    </div>
    <div class="d-flex flex-row">
         <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center"> USUARIO</th>
                  <th scope="col" class="text-center">TELEFONO</th>
                  <th scope="col" class="text-center" >CORREO</th>
                  <th scope="col" class="text-center" >RFC</th>
                  <th scope="col" class="text-center" >RAZON SOCIAL</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($detallerepresen as $rowr) { ?>
                <tr class="color_rojo_suave">
                 
                    <td class="text-center" >
                     <a href="representante_sucursal.php?idr=<?php echo $rowr['id']; ?>&&ids=<?php echo $rowr['idsuc']; ?>" class="rojo_obscuro"><i class="fas fa-eye"></i></a>
                   </td>
                  
                  <td class="text-center"> <?php echo $rowr['nomrepre']; ?> </td>
                  <td class="text-center"><?php echo $rowr['telrepre']; ?></td>
                  <td class="text-center">
                  <?php echo $rowr['correorepre']; ?>
                  </td>
                  <td class="text-center">
                  <?php echo $rowr['rfcrepre']; ?>
                  </td>
                  <td class="text-center">
                  <?php echo $rowr['razonsocialrepre']; ?>
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

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
      const button = document.querySelector('#button');
      const tooltip = document.querySelector('#tooltip');

      Popper.createPopper(button, tooltip);
    </script>
</body></html>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>