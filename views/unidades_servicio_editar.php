<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente

require_once("../model/unidades.php");
$col= new consul();
$col2= new consul();
$col3= new consul();
$col4= new consul();

$nserie = $_GET['idu'];
$detalleCol = $col2->nomcolaborador($_SESSION['idc']);
$detalleSuc = $col3->nomsucursal($_SESSION['ids']);
$detalleunid = $col4->unidadesid($nserie);
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  </head>
 
  <body>
  


  <!-- Content here -->          
<div class="container border border-secondary">
  <div class="row bg-dark">
              <div class="col-md-4 d-none d-md-block"><img src="../content/imagenes/logo.png" alt="IRIS" class="logo_iris"></div>
              <div class="col-sm-6 col-md-4 text-center user_text"><?php foreach ($detalleCol as $row2) { ?> <span class="gris_claro">Bienvenido:</span> <?php echo $row2['cuenta'];} ?>  </div>  
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
        <a href="#" ><i class="fas fa-trash-alt m-3" data-toggle="tooltip" data-placement="right" title="Tirar"></i></a> 
             
    </div>
  </div> 
      
      <!--Segunda columna-->
      <div class=""> 
        <div class="contenedor_cabezal  border_seccion bg-white">
          <div class="float-right m-3"><a href="unidades.php"><i class="fas fa-chevron-left rojo_obscuro fa-2x"></i></a></div>
          <h1 class="text-center rojo_obscuro titulo_seccion mt-3">Servicios de la  Unidad </h1>
         <div class="text-white bg-dark box_circule rounded-circle m-2"> <i class="fas fa-truck m-3"></i></div>
         <?php foreach ($detalleunid as $rowu) { ?>
        <h3 class="mt-4 rojo_obscuro"><?php echo $rowu['nomuni']; ?> </h3>
        <input hidden name="idun" id="idun" type="text" value="<?php echo $rowu['noserie']; ?>">
        <?php  foreach ($detalleSuc as $rows) {?>
        <h4 class="m-2"><?php echo $rows['nomsuc']; ?></h4>
        <input hidden type="text" id="idscur" value="<?php echo $rows['id']; ?>">
        <?php } ?>
      </div>
      <div class="d-flex justify-content-between ">
          <div class="p-2 ">
            <img src="<?php echo $rowu['foto']; ?>" alt="transporte_imagen" class="img-fluid img-thumbnail mx-auto border-danger shadow" width="150px;">
            </div>
        <?php } ?>
            <div class="text-center rojo_obscuro m-2">
              <h4><i class="fas fa-oil-can m-3  fa-lg" data-placement="right" title="Mantenimiento"></i>Historico de Gastos editar detalle</h4>
            </div>
            <div>
                <a href="unidades_calendario.php" type="button" class="btn btn-dark btn-lg m-3 rojo_obscuro_btn" >
              <i class="far fa-calendar m-3"></i>
            Calendario</a>
            </div>
          </div>
          <div class="col-sm-12 d-flex m-3">
                <div class="font-weight-bold p-2 col-sm-9 col-md-6">
              <input class="form-check-input mant" checked type="radio" name="mantenimiento" id="noprogramado" value="Mantenimiento No programado"> Gasto no programado
              
              <select  name="manNoProgramado" id="manNoProgramado" class="p-2 color_rojo_suave rojo_obscuro font-weight-bold form-control" onchange="addNewRegNoProgramado('manNoProgramado');">
                    <option selected value="1"> Seleccione Gasto No Programado</option>
                    
                    <option value="Multas">Multas</option>
                    <option value="Hojalatería, Pintura y Tapiceria">Hojalatería, Pintura y Tapiceria</option>
                    <option value="Suspensión">Suspensión</option>
                    <option value="Mecánico">Mecánico</option>
                    <option value="Eléctrico">Eléctrico</option>
                    <option value="Frenos">Frenos</option>
                    <option value="Llanta">Llanta</option>
                    <option value="otro1">Otro</option>
                    
                </select>
                <br>
                <input class="form-control rojo_obscuro color_rojo_suave" type="text" name="otromante1" id="otromante1" value="">
                
              </div>
               <div class="font-weight-bold p-2 col-sm-9 col-md-6">
                 
               <input class="form-check-input mant" type="radio" name="mantenimiento" id="programado" value="Mantenimiento programado"> Gasto Programado
                  <select name="mantProgramado" id="mantProgramado" class="p-2 color_rojo_suave rojo_obscuro font-weight-bold form-control" onchange="addNewRegProgramado('mantProgramado');">
                    <option value="1"> Seleccione Gasto Programado</option>
                    <option value="Afinación"> Afinación</option>
                    <option value="Frenos">Frenos</option>
                    <option value="Lavado y engrasado">Mtto menor</option>
                    <option value="Cambio de llantas">Refrendo</option>
                    <option value="Llantas">Llantas</option>
                    <option value="Mecánicos">Mecánicos</option>
                    <option value="Seguro">Seguro</option>
                    <option value="otro2">Otro</option>
                </select>
                <br>
                <input class="form-control rojo_obscuro color_rojo_suave" type="text" name="otromante2" id="otromante2" value="">
            </div>
       
          </div>
          <div class="d-flexjustify-content-between m-3">
               <div class="font-weight-bold p-2">
                Insertar descripcción:
                <textarea name="descripcion" id="descripcion" class="rojo_obscuro color_rojo_suave form-control ml-4" style="height: 150px; width:98%;">
                   
                </textarea>
              </div>
                   
          </div>
        
           <div class="d-flex justify-content-between m-3">
              <div class="font-weight-bold p-2">
                Afectación de disponibilidad: 
                <select name="select_disponibilidad" id="select_disponibilidad" onchange="pagoOnChange('select_disponibilidad');" class="p-2 color_rojo_suave rojo_obscuro font-weight-bold form-control" >
                    
                    <option value="Si" >Si</option>
                    <option value="No">No</option> 
                                 
                </select>
              </div>
              <input hidden id="idserv" type="text" value="4">
              
               <div class="font-weight-bold p-2">
                 Fecha Inicial: 
               <input type="date" name="Inifecha" id="Inifecha"class="form-control rojo_obscuro color_rojo_suave">
               <p style="color:red;font-size:0.8em;display:none" id="alertaFechaInicio2">Ingresa una fecha valida</p>
              </div>
               <div class="font-weight-bold p-2">
                Fecha Final: 
                <input type="date" name="Finfecha" id="Finfecha"class="form-control rojo_obscuro color_rojo_suave">  
                <p style="color:red;font-size:0.8em;display:none" id="alertaFechaInicio3">Ingresa una fecha valida</p>           
            </div> 
            <div class="font-weight-bold p-2">
                Costo: 
                <input type="txt" name="costomante" id="costomante"class="form-control rojo_obscuro color_rojo_suave">             
            </div>
                   
          </div>
          <div class="font-weight-bold p-2 " style=" text-align: center;">
                <button type="button"  class="btn btn-dark btn-lg m-3 rojo_obscuro_btn" value="generarMantenimineto" id="generarMantenimineto">           
            Guardar Cambios</button>        
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
  <script src="../content/js/bootstrap.min.js"></script>
  <script>

function pagoOnChange(sel) {
      var options = $("#"+sel).val();
      if (options=="Si"){
        //alert(options);
        let today = new Date().toISOString().split("T")[0];
        document.getElementsByName("Inifecha")[0].setAttribute("min", today);
        document.getElementsByName("Finfecha")[0].setAttribute("min", today);
      }
      if (options=="No"){
        //alert(options);
        let today = new Date().toISOString().split("T")[0];
        document.getElementsByName("Inifecha")[0].setAttribute("min", today-1);
        document.getElementsByName("Finfecha")[0].setAttribute("min", today-1);
      }
}

$("#costomante").on({
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


    $("#mantProgramado").css("display", "none");
    $("#manNoProgramado").css("display", "block");
    $("#otromante1").css("display", "none");
    $("#otromante2").css("display", "none");
    $(".mant").click(function(evento){
          
          var valor = $(this).val();
        
          if(valor == 'Mantenimiento No programado'){
              $("#mantProgramado").css("display", "none");
              $("#manNoProgramado").css("display", "block");
              
          }else{
            $("#mantProgramado").css("display", "block");
              $("#manNoProgramado").css("display", "none");
          }
  });

  function addNewRegProgramado(select){
    var option = $("#"+select).val();
    
   if(option=="otro2"){ 
     $( "#otromante2" ).css("display", "block");
    
    }
    if(option!="otro2"){ 
      $( "#otromante2" ).css("display", "none");
      
    }
  }
  function addNewRegNoProgramado(select){
    var option = $("#"+select).val();
  
   if(option=="otro1"){ 
     $( "#otromante1" ).css("display", "block");
    
    }
    if(option!="otro1"){ 
      $( "#otromante1" ).css("display", "none");
      
    }
  }

  window.addEventListener("load", function() {
    costomante.addEventListener("keypress", soloNumeros, false);
});

//Solo permite introducir numeros.
function soloNumeros(e){
  var key = window.event ? e.which : e.keyCode;
  if (key < 48 || key > 57) {
    e.preventDefault();
  }
}



    </script>
</body></html>
