<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente

require_once("../model/unidades.php");

$col2= new consul();
$col3= new consul();

$detalleCol = $col2->nomcolaborador($_SESSION['idc']);
$detalleSuc = $col3->nomsucursal($_SESSION['ids']);

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
    <script rel="stylesheet" href="../content/js/popper.min.js"></script>

    
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
        <a href="unidades.php"><i class="fas fa-truck m-3 " data-toggle="tooltip" data-placement="right" title="Vehículos">
        </i></a>
        <a href="unidades_editar.php" ><i class="far fa-edit m-3 active" data-toggle="tooltip" data-placement="right" title="Editar"></i></a>
        <a href="unidades_add.php" ><i class="far fa-plus-square m-3" data-toggle="tooltip" data-placement="right" title="Agregar"></i></a>
        
         <a href="unidades_calendario.php" ><i class="far fa-calendar m-3" data-toggle="tooltip" data-placement="right" title="Calendario"></i></a>
         <a href="unidades_baja.php" ><i class="fas fa-trash-alt m-3" data-toggle="tooltip" data-placement="right" title="Tirar"></i></a>
             
    </div>
  </div> 
      
      <!--Segunda columna-->
      <div class=""> 
        <div class="contenedor_cabezal  border_seccion bg-white">
          <div class="float-right m-3"><a href="unidades.php"><i class="fas fa-chevron-left rojo_obscuro fa-2x"></i></a></div >
       <h1 class="text-center rojo_obscuro titulo_seccion mt-3">Agregar de Unidad </h1>
       <form  action="../controller/add_unidad.php" method="post" enctype="multipart/form-data">
         <div class="d-flex mt-5">
           <div class="text-white bg-dark box_circule rounded-circle "> <i class="fas fa-truck m-3"></i></div>
         <input type="text" class=" form-control rojo_obscuro bg-white border border-warnig m-3 p-2 " name="nombre" id="nombre" style="width: 300px;" value="" placeholder="Nombre del vehículo"> <br>
         
         </div>

         <?php foreach ($detalleSuc as $row3) { ?>
                <input hidden type="text" value="<?php echo $row3['id']; ?>" id="idsucursal" name="idsucursal">
              
              <?php } ?>
         
      </div>
      <div class="d-flex flex-row ">
          <div class="text-white p-2">
            
              <table width="500px;" style="margin-top: 40px;">
                <tr>
                  <td class="text-right">FECHA DE ALTA: </td>
                  <td class="text-left p-2"> 
                    <input type="date" class=" form-control bg-transparent text-white border-white  border " name="fecha" id="fecha" value="">
                  </td>
                </tr>
                <tr>
                  <td class="text-right">MARCA: </td>
                  <td class="text-left p-2">
                    <input type="text" class=" form-control bg-transparent text-white border-white  border " name="marca" id="marca" value="">
                  </td>
                </tr>
                <tr>
                  <td class="text-right">MODELO: </td>
                  <td class="text-left p-2">
                    <input type="text" class=" form-control bg-transparent text-white border-white  border " name="modelo" id="modelo" value=""> 
                 </td>
                </tr>
                <tr>
                  <td class="text-right">NUMERO DE SERIE: </td>
                  <td class="text-left p-2">
                    <input type="text" class=" form-control bg-transparent text-white border-white  border " name="numserie" id="numserie" value="">
                  </td>
                </tr>
                <tr>
                <td class="text-right">PLACAS: </td>
                  <td class="text-left p-2">
                    <input type="text" class=" form-control bg-transparent text-white border-white  border " name="placas" id="placas" value="">
                  </td>
                </tr>
                <td class="text-right">CAJA: </td>
                  <td class="text-left p-2">
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="caja" id="caja" value="si">
                    <label class="form-check-label" for="inlineRadio1">Si</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="caja" id="caja" value="no">
                  <label class="form-check-label" for="inlineRadio2">No</label>
                  </div>    
                  </td>
                </tr>
                <td class="text-right">EQUIPO DE REFRIGERACION <br>(THERMO) </td>
                  <td class="text-left p-2">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="refrigeracion" id="refrigeracion" value="si">
                    <label class="form-check-label" for="inlineRadio1">Si</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="refrigeracion" id="refrigeracion" value="no">
                  <label class="form-check-label" for="inlineRadio2">No</label>
                  </div>
                </td>
                </tr>
                <tr>
                <td class="text-right">CAPACIDAD MAXIMA DE CARGA: </td>
                  <td class="text-left p-2"> <input type="text" class=" form-control bg-transparent text-white border-white  border " name="capasidad" id="capasidad" value=""> </td>
                </tr>
                <td class="text-right">COSTO DE ADQUISICION: $ </td>
                  <td class="text-left p-2"> <input type="text" class=" form-control bg-transparent text-white border-white  border " name="costo" id="costo" value=""> </td>
                </tr>
              </table>
             
          </div>
          <div class="text-center m-3">
            <p class="text-white text-center m-3">Editar foto </p>
            <div class="imagen">
            <img id="imgSalida" src="" alt="transporte_imagen" class="img-fluid img-thumbnail mx-auto border-white shadow" width="268px;" height="100px;" >
            </div>
     
            <input type="file" class="form-control mt-2" name="foto1" id="foto1">
             
              <textarea class="form-control m-3 bg-transparent text-white border-white  border" id="comentario" rows="3" placeholder="" name="comentario" width="368px;" >
                
              </textarea>
              <?php foreach ($detalleCol as $row2) { 
            if($row2['idrol']==1 || $row2['idrol']==3){
          
          ?>       
            <button type="submit" name="add_unidad" class="btn btn-dark btn-lg m-3" value="Guardar datos" disabled>
           <!-- <button type="button" class="btn btn-dark btn-lg m-3" data-toggle="modal" data-target="#guardar_cambios">-->
            Guardar Cambios
          </button>
           <button type="button" class="btn btn-danger btn-lg m-3" data-toggle="modal" data-target="#elimnar_datoss" disabled>
            Cancelar cambios
          </button>

          <?php } if($row2['idrol']==2){ ?>

            <button type="submit" name="add_unidad" class="btn btn-dark btn-lg m-3" value="Guardar datos">
           <!-- <button type="button" class="btn btn-dark btn-lg m-3" data-toggle="modal" data-target="#guardar_cambios">-->
            Guardar Cambios
          </button>
           <button type="button" class="btn btn-danger btn-lg m-3" onclick="location.href='unidades.php'">
            Cancelar cambios
          </button>

          <?php   
        } 
      }
          ?>
          </div>
          </form>
         </div>


            
      </div>
      


      <!-- termina seguda columna-->
      </div>
    

    </div>
   
 



    </div>
    
</div>
  </div>
</div>       

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!--<script src="../content/js/jquery-3.3.1.min.js"></script>-->
  <script src="../content/js/bootstrap.min.js"></script>
  <script>
   function mostrar(){
     alert("entra a")
   }

  $(window).load(function(){

$(function() {
 $('#foto1').change(function(e) {
  	 addImage(e); 
	});

	function addImage(e){
	 var file = e.target.files[0],
	 imageType = /image.*/;
   
	 if (!file.type.match(imageType))
	  return;
 
	 var reader = new FileReader();
	 reader.onload = fileOnload;
	 reader.readAsDataURL(file);
	}
 
	function fileOnload(e) {
	 var result=e.target.result;
	 $('#imgSalida').attr("src",result);
	}
   });
 });

 $("#costo").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
        });
    }
});

$("#capasidad").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
        });
    }
});
  
     
    </script>
</body></html>
