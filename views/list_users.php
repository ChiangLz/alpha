<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente
require_once("../model/add_users_model.php");
$consul= new consul();
$list_users = $consul->getUsers();

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
               <span class="gris_claro">Bienvenido:</span> <?php echo $row2['cuenta'];  ?>
               
                </div>  
              <div class="col-sm-6 col-md-4 iconos_menu ">
                <div class="text-center">
                <a href="menus_cuadros.php"><i class="fas fa-th"></i></a>
                
             
                <a href="#"><i class="fas fa-question-circle"></i></a> 
                <a href="../model/cerrar.php"><i class="fas fa-user-times"></i></a>                                  
                </div>
              </div>   
  </div>    
      <!--Segunda columna-->
      <div class=""> 
        <div class="contenedor_cabezal  border_seccion bg-white mb-2">          
          <h1 class="text-center rojo_obscuro titulo_seccion mt-3 mb-2">Usuarios Listado</h1>    
      </div>
     
      <div>
         <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="text-center">Nombre completo</th>
                  <th scope="col" class="text-center">Correo</th>
                  <th scope="col" class="text-center">Cuenta</th>
                  <th scope="col" class="text-center">Contraseña</th>
                  <th scope="col" class="text-center">Rol</th>
                  <th scope="col" class="text-center">Sucursal</th>
                  <th scope="col" class="text-center">Fecha de creación</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($list_users as $row) { ?>
                <tr class="color_rojo_suave">
                  <td class="text-center" ><?php echo $row["nomcol"]; ?></td>
                  <td class="text-center"><?php echo $row["correo"]; ?></td>
                  <td class="text-center"><?php echo $row['cuenta']; ?></td>
                  <td class="text-center"><?php echo $row['contra']; ?></td>
                  <td class="text-center"><?php echo $row['tipo_rol']; ?></td>
                  <td class="text-center"><?php echo $row['nomsuc']; ?></td>
                  <td class="text-center"><?php echo $row['fechacol']; ?></td>
                </tr>
                <?php } ?>
              
                
              </tbody>
            </table>
      </div>
  

    
      


   

        

            




      




    
        
          


               
    </div>

      

    
   <!-- termina seguda columna-->
    </div>
   
 
              <?php }?>


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