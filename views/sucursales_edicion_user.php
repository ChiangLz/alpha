<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente
require_once("../model/model_sucursal.php");
if($_SESSION['rol']==="SuperAdministrador"){
  $idcolsuc = $_GET['idcol'];
  $idsucur = $_GET['ids'];
  $col= new consul();
  $detallecolsuc = $col->colaboradorSucIc($idsucur);
  $col2= new consul();
  $detallecoledit = $col2->colaborador($idcolsuc);
  $col3= new consul();
  $roles = $col2->roladm();
  $col1= new consul();
  $detalleCol = $col1->colaboradores($_SESSION['idc']);
  $col5= new consul();
  $detalleSuc = $col5->sucursal($idsucur);
 
}else{
  $idcolsuc = $_GET['idcol'];
  $col= new consul();
  $detallecolsuc = $col->colaboradorSucIc($_SESSION['ids']);
  $col2= new consul();
  $detallecoledit = $col2->colaborador($idcolsuc);
  $col3= new consul();
  $roles = $col2->rol();
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
        <?php if($row['idrol']==1){ 
          foreach ($detalleSuc as $row6) {?>
          <a href="sucursales_detalle.php?ids=<?php echo $row6['id']; ?>"><i class="fas fa-building m-3 " data-toggle="tooltip" data-placement="right" title="Sucursales">
       
        </i>
        </a>
        <?php } }else{?>
          <a href="sucursales_detalle.php"><i class="fas fa-building m-3 " data-toggle="tooltip" data-placement="right" title="Sucursales">
       
        </i>
        </a>
       <?php }?>
    </div>
  </div>      
      <!--Segunda columna-->
      <div class=""> 
        <div class="contenedor_cabezal  border_seccion bg-white mb-2">          
          <h1 class="text-center rojo_obscuro titulo_seccion mt-3 mb-2">Sucursales Editar Usuario</h1>    
      </div>
     

      <form  action="../controller/add_colaborador.php" method="post" enctype="multipart/form-data">

     

     <div class="d-flex justify-content-center p-3">
            <div class="border rounded p-3 text-center box_sucursal m-3">
            
            <?php foreach ($detallecoledit as $row2) { ?>
              <i class="fas fa-user-cog fa-4x m-3 rojo_obscuro"></i>
              <input hidden type="text" name="idsuc" id="idsuc" value="<?php echo $row2['idsc']; ?>">
              <input hidden type="text" name="idcola" id="idcola" value="<?php echo $row2['idcols']; ?>">
              <input hidden type="text" name="fecha" id="fecha" value="<?php echo $row2['fcol']; ?>">
              <input hidden type="text" name="correo" id="correo" value="<?php echo $row2['correocol']; ?>">
              <input hidden type="text" name="cuenta" id="cuenta" value="<?php echo $row2['nomc']; ?>">
              <input hidden type="text"  id="rolid" name="rolid" value="<?php echo $row['idrol']; ?>">
              <input hidden type="text"  id="rolid2" name="rolid2" value="<?php echo $row2['id_rol']; ?>">
              <p class=" h5"> Editar Usuario:
               <?php if($row['idrol']==1){ ?>
                <input type="text"  class="form-control" name="nomcola" id="nomcola" value="<?php echo $row2['cuecol']; ?>" style="width:400px">
               <?php } else{?>
                <input type="text"  class="form-control" name="nomcola" id="nomcola" value="<?php echo $row2['cuecol']; ?>" style="width:400px" readonly>
               <?php }?>
              </p> <br>

              <p class="font-weight-bold ">Editar Contraseña:
              <input type="password" class="form-control activar" name="contracola" id="contracola" value="<?php echo $row2['contra']; ?>" style="width:400px; "></p>
              <p class="font-weight-bold "> 
               Editar Privilegios: 

               <?php if($row['idrol']==1){ ?>
              <select name="id_rol" id="id_rol" class="p-2 color_rojo_suave rojo_obscuro font-weight-bold form-control">
              <?php
                        foreach ($roles as $ro) { 
                    ?>
                        <option value="<?php echo $ro['id_rol']; ?>"> <?php echo $ro['tipo_rol']; ?></option>
                        <?php
                        }
                    ?>
                   
                    
                </select>
                <?php } else{?>
                  <select name="id_rol" id="id_rol" class="p-2 color_rojo_suave rojo_obscuro font-weight-bold form-control" disabled>
              <?php
                        foreach ($roles as $ro) { 
                    ?>
                        <option value="<?php echo $ro['id_rol']; ?>"> <?php echo $ro['tipo_rol']; ?></option>
                        <?php
                        }
                    ?>
                   
                    
                </select>
                  <?php }?>
                
            </p>

        <?php 
          } ?>
            <div class="d-flex justify-content-center">
            <?php if($row['idrol']==1){ foreach ($detalleSuc as $row6) {?>
              <a href="sucursales_detalle.php?ids=<?php echo $row6['id']; ?>" type="button" class="btn btn-dark  m-3">
              Cancelar Cambios</a>
              <?php }} else {?>
               
                <a href="sucursales_detalle.php?" type="button" class="btn btn-dark  m-3"> Cancelar Cambios</a>
                <?php }?>
              <!--<a href="sucursales_detalle.php" type="button" class="btn btn-dark  m-3 rojo_obscuro_btn">
              Guardar Cambios</a>-->
              <button type="submit" name="edit_col" class="btn btn-dark  m-3 rojo_obscuro_btn" value="Guardar datos">
                       Guardar Cambios
          </button>
            </div>
        </div>
    </div>

    </form>

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
              <?php foreach ($detallecolsuc as $rowx) { ?>
                <tr class="color_rojo_suave">
                  <td class="text-center" >
                  <?php if($row['idrol']==1){?>
                    <a href="sucursales_edicion_user.php?idcol=<?php echo $rowx['idcol']; ?>&ids=<?php echo $rowx['idsuc']; ?>" class="rojo_obscuro"><i class="fas fa-eye"></i></a>
                  <?php } else{?>
                    <a href="sucursales_edicion_user.php?idcol=<?php echo $rowx['idcol']; ?>" class="rojo_obscuro"><i class="fas fa-eye"></i></a>
                    <?php }?>
                  </td>
                  <td class="text-center"> <a  class="rojo_obscuro"><?php echo $rowx['cuenta']; ?></a> </td>
                  <td class="text-center"><?php echo $rowx['fechacol']; ?></td>
                  <td class="text-center">
                  <?php echo $rowx['tipo_rol']; ?>
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
 
