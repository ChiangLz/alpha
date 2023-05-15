<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente
$nserie = $_GET['ns'];
require_once("../model/unidades.php");
$col= new consul();
$col2= new consul();
$col3= new consul();
$detalleUniId = $col->unidadesid($nserie);
$detalleCol = $col2->nomcolaborador($_SESSION['idc']);
$detalleSucUni = $col3->nomsucursal($_SESSION['ids']);
?>
<style>
#conte-modal {
	text-align: center;
	padding: 10px;
}
#fondo {
	background: url(imagenes/DB.png) no-repeat;
	max-width: 650px;
	text-align: center;
	color: #FFF;
	/* This works in IE 8 & 9 too */
	filter: alpha(opacity=60);
	-moz-opacity:0.6;
	/* Safari 1.x (pre WebKit!) */
	-webkit-opacity: 0.6;
	-o-opacity: 0.6;
	opacity: 0.6;
	background-size:100% auto;
}
.mo-title {
	font-size: 2em;
	margin-bottom: 350px;
}


</style>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    
  </head>
 
  <body>
  


  <!-- Content here -->          
<div class="container">
  <div class="row bg-dark">
              <div class="col-md-4 d-none d-md-block"><img src="../content/imagenes/logo.png" alt="IRIS" class="logo_iris"></div>
              <div class="col-sm-6 col-md-4 text-center user_text"> 
              <?php foreach ($detalleCol as $row2) { ?>
              <span class="gris_claro">Bienvenido:</span> <?php echo $row2['cuenta']; ?>
              <?php } ?>
              </div>  
              <div class="col-sm-6 col-md-4 iconos_menu ">
                <div class="text-center">
                <a href="menus_cuadros.php"><i class="fas fa-th"></i></a>
                
           
                <a href="#"><i class="fas fa-question-circle"></i></a>     
                <a href="../model/cerrar.php"><i class="fas fa-user-times"></i></a>                              
                </div>
              </div>   
  </div>
  <div class="row degradado">
    <div class="d-flex flex-row">
      <div> 
        <div class="menu_lateral iconos_menu degradado ">
        <a href="unidades.php"><i class="fas fa-truck m-3 active" data-toggle="tooltip" data-placement="right" title="Vehículos">
        </i></a>
        <a href="unidades_editar.php" ><i class="far fa-edit m-3" data-toggle="tooltip" data-placement="right" title="Editar"></i></a>
        <a href="unidades_add.php" ><i class="far fa-plus-square m-3" data-toggle="tooltip" data-placement="right" title="Agregar"></i></a>
       
         <a href="#" ><i class="far fa-calendar m-3" data-toggle="tooltip" data-placement="right" title="Calendario"></i></a>
        <a href="#" ><i class="fas fa-trash-alt m-3" data-toggle="tooltip" data-placement="right" title="Tirar"></i></a> 
        
             
    </div>
  </div>
 
      <!--Segunda columna-->
      <div class=""> 
        <div class="contenedor_cabezal  border_seccion bg-white">
          <div class="float-right m-3"><a href="unidades.php"><i class="fas fa-chevron-left rojo_obscuro fa-2x"></i></a></div>
          <h1 class="text-center rojo_obscuro titulo_seccion mt-3">Detalle de Unidad </h1>
         <div class="text-white bg-dark box_circule rounded-circle m-2"> <i class="fas fa-truck m-3"></i></div>
         <?php foreach ($detalleUniId as $row) { ?>
         <h3 class="mt-4 rojo_obscuro"><?php echo $row['nomuni']; ?> </h3>
         <?php } foreach ($detalleSucUni as $row3) { ?>
        <h4 class="m-2"><?php echo $row3['nomsuc']; ?></h4>
        <?php } ?>

      </div>
      <div class="d-flex flex-row ">
          <div class="text-white ">
           
              <table width="500px;" style="margin-top: 40px;">
              <?php foreach ($detalleUniId as $row) { ?>
                <tr>
                  <td class="text-right">FECHA DE ALTA:</td>
                  <td class="text-left p-2"> <?php echo $row['fecha_alta']; ?></td>
                </tr>
                <tr>
                  <td class="text-right">MARCA: </td>
                  <td class="text-left p-2"> <?php echo $row['marca']; ?></td>
                </tr>
                <tr>
                  <td class="text-right">MODELO: </td>
                  <td class="text-left p-2"> <?php echo $row['modelo']; ?></td>
                </tr>
                <tr>
                  <td class="text-right">NUMERO DE SERIE: </td>
                  <td class="text-left p-2"> <?php echo $row['serie']; ?> </td>
                </tr>
                <tr>
                <td class="text-right">PLACAS: </td>
                  <td class="text-left p-2"> <?php echo $row['placas']; ?> </td>
                </tr>
                <td class="text-right">CAJA: </td>
                  <td class="text-left p-2">
                  <?php if($row['caja']=="si"){?>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptionss" id="inlineRadio11" value="option1" checked>
                    <label class="form-check-label" for="inlineRadio1">Si</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptionss" id="inlineRadio22" value="option2">
                  <label class="form-check-label" for="inlineRadio2">No</label>
                  </div> 
                  <?php }else{?>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptionss" id="inlineRadio11" value="option1" >
                    <label class="form-check-label" for="inlineRadio1">Si</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptionss" id="inlineRadio22" value="option2" checked>
                  <label class="form-check-label" for="inlineRadio2">No</label>
                  </div> 
                  <?php }?>
                  </td>
                </tr>
                <td class="text-right">EQUIPO DE REFRIGERACION <br>(THERMO) </td>
                  <td class="text-left p-2">
                  <?php if($row['refrigeracion']=="si"){?>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="" checked>
                    <label class="form-check-label" for="inlineRadio1">Si</label>
                  </div>
                
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                  <label class="form-check-label" for="inlineRadio2">No</label>
                  </div>
                  <?php }else{?>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="" >
                    <label class="form-check-label" for="inlineRadio1">Si</label>
                  </div>
                
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" checked>
                  <label class="form-check-label" for="inlineRadio2">No</label>
                  </div>

                  <?php } ?>
                </td>
                </tr>
                <tr>
                <td class="text-right">CAPACIDAD MAXIMA DE CARGA: </td>
                  <td class="text-left p-2"> <?php echo $row['capasidad_max']; ?> </td>
                </tr>
                <td class="text-right">COSTO DE ADQUISICION: </td>
                  <td class="text-left p-2"><?php echo $row['costo_adquisicion']; ?> </td>
                </tr>
                <?php } ?>
              </table>
          </div>
          <div class="bg-white text-center " style="width:570px">
          <?php foreach ($detalleUniId as $row) { ?>
            <img src="<?php echo $row['foto']; ?>" alt="transporte_imagen" class="img-fluid img-thumbnail mx-auto m-5 border-danger shadow" width="268px;" height="268px;">
            <p class="m-2 p-2 text-left"><?php echo $row['descripuni']; ?></p>

            <a href="unidades_servicio.php?idu=<?php echo $row['noserie']; ?>" type="button" class="btn btn-dark btn-lg m-3">
              <i class="fas fa-oil-can m-3"></i>
            Gastos</a>
            
            <a class="baja_unidad btn btn-dark btn-lg m-3" baja="<?php echo $row['noserie']; ?>" type="button" style="color:white;" >
              <i class="fas fa-trash-alt  m-3" style="color:white;"></i>
            Baja</a>
            
           
            <?php }?>
          </div>
         
         </div> 


            
      </div>
     

      <!-- termina seguda columna-->
      </div>
    

    </div>
   
 



    </div>
    
</div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="../content/js/funciones.js"></script>
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



 


 