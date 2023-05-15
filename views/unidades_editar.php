<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente

require_once("../model/unidades.php");

$col2= new consul();
$detalleCol = $col2->nomcolaborador($_SESSION['idc']);
$col3= new consul();
$SelectUni = $col3->todos_unidades($_SESSION['ids']);

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
    <script  href="../content/js/popper.min.js"></script>
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
       <h1 class="text-center rojo_obscuro titulo_seccion mt-3">Edición de Unidad </h1>
         <div class="d-flex mt-5">
           <div class="text-white bg-dark box_circule rounded-circle "> <i class="fas fa-truck m-3"></i></div>
         <!--<input type="text" class=" form-control rojo_obscuro bg-white border border-warnig m-3 p-2 " style="width: 300px;" value="" placeholder="Nombre del vehículo"> <br>-->
         <select class="form-control rojo_obscuro bg-white border border-warnig m-3 p-2" id="unidades" style=" width:300px" onChange="mostrar()">
         <option value="">SELECCIONAR UNIDAD:</option>
          <?php foreach($SelectUni as $rowP){?>
          <option value="<?php echo $rowP['noserie']?>"><?php echo $rowP['nomuni']?></option>
          <?php }  ?>
          </select>
          <form action="../controller/add_unidad.php" method="post" enctype="multipart/form-data">
          <input type="text" class="form-control rojo_obscuro bg-white border border-warnig m-3 p-2" style=" width:300px" id="nombre" name="nombre">
         </div>
         
      </div>
      <div class="d-flex flex-row ">
          <div class="text-white p-2">
              
              <input hidden type="text" id="iduni" name="iduni" value="">
              <input hidden type="text" id="iddis" name="iddis" value="">
              <input hidden type="text" id="tip" name="tip" value="">
              <input hidden type="text" id="ids" name="ids" value="">
              <input hidden type="text" id="acti" name="acti" value="">
              <table width="500px;" style="margin-top: 40px;">
                <tr>
                  <td class="text-right">FECHA DE ALTA: </td>
                  <td class="text-left p-2"> 
                    <input type="date" class=" form-control bg-transparent text-white border-white  border " name="fecha" id="fecha">
                  </td>
                </tr>
                <tr>
                  <td class="text-right">MARCA: </td>
                  <td class="text-left p-2">
                    <input type="text" class=" form-control bg-transparent text-white border-white  border " name="marca" id="marca">
                  </td>
                </tr>
                <tr>
                  <td class="text-right">MODELO: </td>
                  <td class="text-left p-2">
                    <input type="text" class=" form-control bg-transparent text-white border-white  border " name="modelo" id="modelo"> 
                 </td>
                </tr>
                <tr>
                  <td class="text-right">NUMERO DE SERIE: </td>
                  <td class="text-left p-2">
                    <input type="text" class=" form-control bg-transparent text-white border-white  border " name="numserie" id="numserie">
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
                    <input class="form-check-input" type="radio" name="caja" id="caja1" value="si">
                    <label class="form-check-label" for="inlineRadio1" >Si</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="caja" id="caja2" value="no">
                  <label class="form-check-label" for="inlineRadio2">No</label>
                  </div>    
                  </td>
                </tr>
                <td class="text-right">EQUIPO DE REFRIGERACION <br>(THERMO) </td>
                  <td class="text-left p-2">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="refrigeracion" id="refrigeracion1" value="si">
                    <label class="form-check-label" for="inlineRadio1">Si</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="refrigeracion" id="refrigeracion2" value="no">
                  <label class="form-check-label" for="inlineRadio2">No</label>
                  </div>
                </td>
                </tr>
                <tr>
                <td class="text-right">CAPACIDAD MAXIMA DE CARGA: </td>
                  <td class="text-left p-2"> <input type="text" class=" form-control bg-transparent text-white border-white  border " name="capasidad" id="capasidad" value=""> </td>
                </tr>
                <td class="text-right">COSTO DE ADQUISICION: $</td>
                  <td class="text-left p-2"> <input type="text" class=" form-control bg-transparent text-white border-white  border " name="costo" id="costo" value=""> </td>
                </tr>
              </table>
              
          </div>
          <div class="text-center m-3">
            <p class="text-white text-center m-3">Editar foto </p>
            <div class="imagen">
            <img id="imgSalida" name="imgSalida" src="" alt="transporte_imagen" class="img-fluid img-thumbnail mx-auto border-white shadow" width="268px;" height="100px;" >
            </div>
              <input type="file" class="form-control mt-2" name="foto" id="foto">
              <textarea class="form-control m-3 bg-transparent text-white border-white  border" id="comentario" rows="3" placeholder="" name="comentario" width="368px;" >
                
              </textarea>

            <?php foreach ($detalleCol as $row2) { if($row2['idrol']==1 || $row2['idrol']==3){ ?>       
            <button type="button" class="btn btn-dark btn-lg m-3" data-toggle="modal" data-target="#guardar_cambios" disabled>
            Guardar Cambios
          </button>
           <button type="button" class="btn btn-danger btn-lg m-3" data-toggle="modal" data-target="#elimnar_datoss" disabled>
            Cancelar cambios
          </button>
            <?php } if($row2['idrol']==2){ ?>

              <button type="submit" name="edit_unidad" class="btn btn-dark btn-lg m-3" value="editarUnidad1" id="editarUnidad1">
            Guardar Cambios
          </button>
           <button onclick="location.href='unidades.php'" type="button" class="btn btn-danger btn-lg m-3" >
            Cancelar cambios
          </button>
          <?php   }  }    ?>
        
          </div>
         
         </div>

</form>
            
      </div>
      


      <!-- termina seguda columna-->
      </div>
    

    </div>
   
 



    </div>
    
</div>
  </div>
</div>    
<script>
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
  
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="../content/js/funciones.js"></script>
  <script src="../content/js/bootstrap.min.js"></script>
  <script type="text/javascript">
     $("#nombre").hide();

      function mostrar(){
        $("#nombre").show();
 
       var valor= $("#unidades").val();
       var accion='editarunidad'

        $.ajax({
        url: "../controller/select_unidades.php",
        type: "POST",
        async:true,
        data: {accion:accion,valor:valor},
        success: function(response){
          console.log(response);
          if(response != 'error'){
            var info = JSON.parse(response);
            console.log(info);
            $('#iduni').val(info.noserie);
            $('#nombre').val(info.nomuni);
            $('#numserie').val(info.serie);
            $('#fecha').val(info.fecha_alta);
            $('#marca').val(info.marca);
            $('#modelo').val(info.modelo);
            $('#placas').val(info.placas);
           
           // $('#caja').val(info.caja);
           if(info.caja=="si"){
            $("#caja1").prop('checked', true);
           }else{
            $("#caja2").prop('checked', true);
           }

           if(info.refrigeracion=="si"){
            $("#refrigeracion1").prop('checked', true);
           }else{
            $("#refrigeracion2").prop('checked', true);
           }
           
           //$('#refrigeracion"').val(info.refrigeracion);
            $('#capasidad').val(info.capasidad_max);
            $('#costo').val(info.costo_adquisicion);
            $('#comentario').val(info.descripuni);
          
           $("#imgSalida").attr("src",info.foto);
            $('#iddis').val(info.iddispo);
            $('#tip').val(info.tipo);
            $('#ids').val(info.idsuc);
            $('#acti').val(info.ultimaactividad);
          }
        },
        error: function(error){
          console.log(error);
        }
      });


      }  


    </script>
      <script>
  

  $(window).load(function(){

$(function() {
 $('#foto').change(function(e) {
   
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

 
  
     
    </script>
  
</body></html>
<!-- Modal -->
<div class="modal fade" id="guardar_cambios" tabindex="-1" aria-labelledby="GuardarCambios" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Guardar Cambios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p class="text-center">Seguro que desea guardar los cambios</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="elimnar_datoss" tabindex="-1" aria-labelledby="elimnar_datoss" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p class="text-center">Seguro que desea eliminar los cambios</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success">Guardar</button>
      </div>
    </div>
  </div>
</div>