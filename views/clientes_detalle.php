<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente

require_once("../model/clientes.php");

$idc = $_GET['idc'];
$col= new consul();
$detallecliente = $col->clientes($idc);
$col3= new consul();
$detalleSuc = $col3->nomsucursal($_SESSION['ids']);
$col2= new consul();
$detalleCol = $col2->nomcolaborador($_SESSION['idc']);
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
              <div class="col-sm-6 col-md-4 text-center user_text"><?php foreach ($detalleCol as $row2) { ?>
               <span class="gris_claro">Bienvenido:</span> <?php echo $row2['cuenta']; ?> </div>  
              <div class="col-sm-6 col-md-4 iconos_menu ">
                <div class="text-center">
                <a href="menus_cuadros.php"><i class="fas fa-th"></i></a>
                
              
                <a href="#"><i class="fas fa-question-circle"></i></a>
                <a href="../model/cerrar.php"><i class="fas fa-user-times"></i></a>                                   
                </div>
              </div>   
  </div>
  <div class="row ">
    <div class="d-flex justify-content-center">
      <div> 
        <div class="menu_lateral iconos_menu degradado ">
          <a href="clientes.php"><i class="fas fa-suitcase m-2 " data-toggle="tooltip" data-placement="right" title="Clientes">
        </i>
        </a>
        <?php if($row2['idrol']==2 || $row2['idrol']==3){?>
        <a href="add_cliente.php"><i class="far fa-plus-square m-2 " data-toggle="tooltip" data-placement="right" title="Clientes">
       
        </i>
        </a>
        <?php }?>
    </div>
  </div>      
      <!--Segunda columna-->
      <div class=""> 
        <div class="contenedor_cabezal  border_seccion bg-white mb-2">          
          <h1 class="text-center rojo_obscuro titulo_seccion mt-3 mb-2">Clientes Listado</h1>
          <div class="d-flex m-2">
           <div class="text-white bg-dark box_circule rounded-circle m-2"> <i class="fas fa-suitcase m-3"></i></div>  
           <?php if($row2['idrol']!=1){ foreach ($detalleSuc as $row3) { ?>      
           <h4 class=" py-3"><?php echo $row3['nomsuc']; } }?></h4>
         </div> 
      </div>
      <?php foreach ($detallecliente as $row) { ?>
      <div class="d-flex  justify-content-center">
           <table class="table" style="width: 800px;">
              <tr>
                <td class="font-weight-bold"> <i class="fas fa-user-circle fa-2x m-2"></i> Cliente:</td>
                <td  colspan="2" class="font-weight-bold rojo_obscuro text-left"><?php echo $row['nomcli']; ?></td>
              </tr> 
               <tr>
                <td class="font-weight-bold"><i class="fas fa-map-marker-alt fa-2x m-2"></i>Dirección:</td>
                <td  colspan="2" class="font-weight-bold rojo_obscuro text-left"><?php echo $row['dircli']; ?></td>
              </tr>
              <tr>
                <td class="font-weight-bold"> <i class="fas fa-phone fa-2x m-2"></i>  Numero de Celular:</td>
                <td colspan="2" class="font-weight-bold rojo_obscuro text-left"><?php echo $row['celular']; ?></td>
              </tr>
               <tr>
                <td class="font-weight-bold"> <i class="fas fa-envelope  fa-2x m-2"></i> Email:</td>
                <td  colspan="2"   class="font-weight-bold rojo_obscuro text-left"> <?php echo $row['correocli']; ?> </td>
              </tr>
                
              <tr  class="color_rojo_suave text-center">
                <td colspan="3">
                  <h3 class="p-2">Datos Fiscales</h3>
                </td>
              </tr>
              <tr>
                <td class="font-weight-bold"> <i class="fas fa-user-circle fa-2x m-2"></i> Dirección fiscal
:</td>
                <td  colspan="2" class="font-weight-bold rojo_obscuro text-left"><?php echo $row['contacto']; ?></td>
              </tr> 
               <tr>
                <td class="font-weight-bold"><i class="far fa-check-square fa-2x m-2"></i>RFC:</td>
                <td  colspan="2" class="font-weight-bold rojo_obscuro text-left"><?php echo $row['rfc']; ?></td>
              </tr>
              <tr>
                <td class="font-weight-bold"> <i class="fas fa-phone fa-2x m-2"></i> No. Teléfono:</td>
                <td colspan="2" class="font-weight-bold rojo_obscuro text-left"><?php echo $row['telcli']; ?></td>
              </tr>
               <tr>
                <td class="font-weight-bold"> <i class="fas fa-envelope  fa-2x m-2"></i> Email:</td>
                <td  colspan="2"   class="font-weight-bold rojo_obscuro text-left"> <?php echo $row['correofac']; ?> </td>
              </tr>
               <td colspan="3">
               <?php if($row2['idrol']==2 || $row2['idrol']==3){?>
                   <a href="clientes_edicion.php?idcli=<?php echo $row['id']; ?>" type="button" class="btn btn-dark  rojo_obscuro_btn">Editar</a>
                <?php }?>
                </td>
             
             
            </table>

      </div>
      <?php }
      
      }?>

    
      


   

        

            




      




    
        
          


               
    </div>

      

    
   <!-- termina seguda columna-->
    </div>
   
 



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