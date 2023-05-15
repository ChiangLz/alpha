<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente

require_once("../model/model_sucursal.php");
if($_SESSION['rol']==="SuperAdministrador"){
  $ids = $_GET['ids'];
$col= new consul();
$detallecolsuc = $col->colaboradorSucIc($ids);
$col2= new consul();
$detallesuc = $col2->sucursal($ids);
$col1= new consul();
$detalleCol = $col1->colaboradores($_SESSION['idc']);

}else{
  $col= new consul();
  $detallecolsuc = $col->colaboradorSucIc($_SESSION['ids']);
  $col2= new consul();
  $detallesuc = $col2->sucursal($_SESSION['ids']);
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
        
    </div>
  </div>      
      <!--Segunda columna-->
      <div class=""> 
        <div class="contenedor_cabezal  border_seccion bg-white mb-2">          
          <h1 class="text-center rojo_obscuro titulo_seccion mt-3 mb-2">Sucursales</h1>    
      </div>
        <div class="d-flex justify-content-center  p-3">
            <div class="border rounded p-3 text-center box_sucursal m-3">
              <i class="fas fa-building fa-4x m-3 rojo_obscuro"></i>
              <?php foreach ($detallesuc as $row3) { ?>
              <p class="font-weight-bold h5">Sucursal <br> <?php echo $row3['nomsuc']; ?></p> <br>
              <p class="font-weight-bold "> Dirección: <?php echo $row3['dirsuc']; ?></p>
              <p class="font-weight-bold "> Teléfono: <?php echo $row3['telsuc']; ?></p>
              <?php foreach ($detalleCol as $row) { 
                if($row['idrol']==1){  ?>
               <a href="sucursales_edicion_suc.php?id=<?php echo $row3['id']; ?>" type="button" class="btn btn-dark  m-3 rojo_obscuro_btn" >
              Editar Sucursal</a>
              <?php   
               
              } 
            }
            
            }?>   
        </div>
    </div>
    <div class="d-flex rojo_obscuro_btn text-white justify-content-center">
      <div><p class="text-center h4">Listado de Usuarios por Sucursal</p></div>
    </div>
    <div class="d-flex flex-row">
         <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center"> USUARIO</th>
                  <th scope="col" class="text-center">FECHA DE ALTA</th>
                  <th scope="col" class="text-center" >PRIVILEGIOS</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($detallecolsuc as $row2) { ?>
                <tr class="color_rojo_suave">
                 
                    <td class="text-center" >
                    <?php if($row['idrol']==1){ ?>
                       
                    <a href="sucursales_edicion_user.php?idcol=<?php echo $row2['idcol']; ?>&ids=<?php echo $row2['idsuc']; ?>" class="rojo_obscuro"><i class="fas fa-eye"></i></a>
                    <?php } if($row['idrol']==2){?>
                      <a href="sucursales_edicion_user.php?idcol=<?php echo $row2['idcol']; ?>" class="rojo_obscuro"><i class="fas fa-eye"></i></a>
                    <?php }if($row['idrol']==3){?>
                      <a href="sucursales_edicion_user.php?idcol=<?php echo $row2['idcol']; ?>" class="rojo_obscuro"><i class="fas fa-eye" onclick="return false"></i></a>
                      <?php }?>
                    </td>
                  
                  <td class="text-center"> <a  class="rojo_obscuro"><?php echo $row2['cuenta']; ?></a> </td>
                  <td class="text-center"><?php echo $row2['fechacol']; ?></td>
                  <td class="text-center">
                  <?php echo $row2['tipo_rol']; ?>
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

  <script src="../content/js/jquery-3.3.1.min.js"></script>
  <script src="../content/js/bootstrap.min.js"></script>
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