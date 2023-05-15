<?php
  include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente
  require_once("../model/model_servicios.php");
  
  if($_SESSION['rol']==="SuperAdministrador"){
    $col= new consul();
    $detallecliente = $col->select_cliente($_SESSION['ids']);
    $col2= new consul();
    $detalleCol = $col2->nomcolaborador($_SESSION['idc']);
    $col3= new consul();
    $detalleUni = $col3->select_unidadadm();
    $col4= new consul();
    $detalleSer = $col4->select_servicios();
    $col5= new consul();
    $detalleSuc = $col5->nomsucursal($_SESSION['ids']);
  }else{
    $col= new consul();
    $detallecliente = $col->select_cliente($_SESSION['ids']);
    $col2= new consul();
    $detalleCol = $col2->nomcolaborador($_SESSION['idc']);
    $col3= new consul();
    $detalleUni = $col3->select_unidad($_SESSION['ids']);
    $col4= new consul();
    $detalleSer = $col4->select_servicios();
    $col5= new consul();
    $detalleSuc = $col5->nomsucursal($_SESSION['ids']);
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="icon_logo.gif">
  <title>Alfa Logistics MX </title>

  <!-- Bootstrap core CSS -->
  <link async href="../content/css/bootstrap.css" rel="stylesheet">
  <link  async rel="stylesheet" href="../content/css/estilos.css">
  <!-- Custom Fonts -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="../vendor/moment/moment.js"></script>
  <script src="../vendor/moment/moment-with-locales.js"></script>
  <!-- jQuery timepicker library -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <link rel="stylesheet" href="../content/js/popper.min.js">
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
  <link href="../content/css/jquery-ui.css" type="text/css" rel="stylesheet"/>

  <style>
      .input_container ul {
        width: 350px;
        color:#660000;
        border: 1px solid gray;
        position: absolute;
        z-index: 9;
        background: #FDFAFA;
        list-style: none;
        border-radius: 4px;
        padding-left:  5px;
        font-size:12px;
      }
  </style> 
</head>
<body>
  <!-- Content here -->          
  <div class="container border border-secondary">
    <div class="row bg-dark">
      <div class="col-md-4 d-none d-md-block"><img src="../content/imagenes/logo.png" alt="IRIS" class="logo_iris"></div>
      <div class="col-sm-6 col-md-4 text-center user_text"> 
        <?php foreach ($detalleCol as $row2) { ?>
        <span class="gris_claro">Bienvenido:</span> <?php echo $row2['cuenta']; ?> 
        <input hidden type="text" id="rol" name="rol" value="<?php echo $row2['idrol']; ?>">
      </div>  
      <div class="col-sm-6 col-md-4 iconos_menu">
        <div class="text-center">
          <a href="menus_cuadros.php"><i class="fas fa-th"></i></a>
          <a href="#"><i class="fas fa-question-circle"></i></a>   
          <a href="../model/cerrar.php"><i class="fas fa-user-times"></i></a>                                
        </div>
      </div>   
    </div>
    <div class="row">
      <div class="d-flex flex-row">
        <div> 
          <div class="menu_lateral iconos_menu degradado "></div>
        </div>      
        <!--Segunda columna-->
        <!-- <form  action="../controller/add_servicio.php" method="post" enctype="multipart/form-data"> -->
        <div class=""> 
          <div class="contenedor_cabezal  border_seccion bg-white mb-5">
            <div class="float-right m-3"><a href="menus_cuadros.php"><i class="fas fa-chevron-left rojo_obscuro fa-2x"></i></a></div>
            <h1 class="text-center rojo_obscuro titulo_seccion mt-3">Servicios</h1>
            <div class="text-white bg-dark box_circule rounded-circle m-2"> <i class="fas fa-dollar-sign fa-lg m-4"></i></div>
            <h3 class="mt-4 mb-5 rojo_obscuro">Seleccione los parametros </h3>
          </div>
          <?php if($row2['idrol']!=1){
            foreach ($detalleCol as $row2) { ?>
              <input  hidden type="text" name="idc" id="idc" value="<?php echo $row2['id']; ?> ">
            <?php } ?>
            <?php foreach ($detalleSuc as $row3) { ?>
              <input hidden  type="text" name="ids" id="ids"value="<?php echo $row3['idsuc']; ?>">
          <?php } }?>
          <!----------->
          <div id="msj" name="msj" class="font-weight-bold p-1" style="margin-right:70px" hidden>La unidad esta Ocupada</div>
            <!---------------->
          <div class="d-flex justify-content-between m-3  mb-3">
            <div class="font-weight-bold " >
              <!-- <select name="select_cliente" id="select_cliente" class=" color_rojo_suave rojo_obscuro font-weight-bold form-control">
                    <option value="">Cliente</option>
                    <//?php foreach($detallecliente as $rowC){?>
                    <option value="<//?php echo $rowC['id']?>"><//?php echo $rowC['nomcli']?></option>
                    <//?php }  ?>
                  </select>-->
              <div class="input_container">
                <input autocomplete="off" type="text" id="contacto" onkeyup="autocompletar()" class="form-control rojo_obscuro color_rojo_suave " style="width:350px; "  value="" placeholder="Cliente" >
                <ul id="lista_contacto"></ul>
              </div>
            </div>
            <div class="font-weight-bold p-1 " style="margin-left:-140px">
              <select name="select_servicio" id="select_servicio" onchange="pagoOnChange('select_servicio');" class="p-2 color_rojo_suave rojo_obscuro font-weight-bold form-control">
                <option value="">Servicio</option>
                <?php foreach($detalleSer as $rowS){?>
                  <option value="<?php echo $rowS['id']?>"><?php echo $rowS['tipo']?></option>
                <?php } ?>        
              </select>
            </div>
            <div class="font-weight-bold p-1" style="margin-right:70px">
              <select name="select_unidad" id="select_unidad"  class="p-2 color_rojo_suave rojo_obscuro font-weight-bold form-control" >
                <option value="">Unidad</option>
                <?php foreach($detalleUni as $rowU){ if($rowU['iddispo']!=5){ ?>
                  <option value="<?php echo $rowU['noserie']?>"><?php echo $rowU['nomuni']?></option>
                <?php }else{ ?> 
                  <option disabled="disabled" style="color:red" value="<?php echo $rowU['noserie']?>"><?php echo $rowU['nomuni']?></option>
                <?php }}  ?>              
              </select>
            </div>   
          </div>      
          <div id="contenedorFlete" >
            <div class="d-flex justify-content-center m-3" >
              <div class="font-weight-bold p-1">
                Dir. de recolección:       
              </div>
              <div class="font-weight-bold p-2">
                <input type="text" name="direcol" id="direcol" class="form-control rojo_obscuro color_rojo_suave ">
              </div>
              <div class="font-weight-bold p-2 ml-3">
                Dir. de Entrega:
              </div>          
              <div class="font-weight-bold p-2">
                <input type="text" name="direntrega" id="direntrega" class="form-control rojo_obscuro color_rojo_suave ">         
              </div>
              <div class="font-weight-bold p-2 ml-3">
                Ciudad destino:
              </div>     
              <div class="font-weight-bold p-2">
                <input type="text" name="cddes" id="cddes" class="form-control rojo_obscuro color_rojo_suave ">         
              </div>
            </div> 
            <div class="d-flex justify-content-center m-3">
              <div class="font-weight-bold p-2">
                Hora Recoleccion:       
              </div>
              <div class="font-weight-bold p-2">
                <input  name="timeR" id="timeR"  class="form-control rojo_obscuro color_rojo_suave ">
              </div>
              <div class="font-weight-bold p-2 ml-3">
                Hora Cita:
              </div>          
              <div class="font-weight-bold p-2">
                <input  name="timeC" id="timeC"  class="form-control rojo_obscuro color_rojo_suave ">         
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center m-3" >
            <div class="font-weight-bold p-2">
              Fecha Inicial:       
            </div>
            <div class="font-weight-bold p-2">
              <input type="date" name="fecha_inicial" id="fecha_inicial" class="form-control rojo_obscuro color_rojo_suave " >
            </div>
            <div class="font-weight-bold p-2 ml-3" id="divFI1">
              Fecha Final:
            </div>          
            <div class="font-weight-bold p-2" id="divFI2">
              <input type="date" name="fecha_final" id="fecha_final" class="form-control rojo_obscuro color_rojo_suave " >     
            </div>
            <div class="font-weight-bold p-2" id="divFT">
              Total de Dias:       
            </div>
            <div class="font-weight-bold p-2">
              <input type="text" name="fecha_Total" id="fecha_Total" size="2"class="form-control rojo_obscuro color_rojo_suave" disabled>
            </div>
          </div>
          <div>
            <div id="divhora">
              <div  class="d-flex justify-content-center m-3" id="divHora" >
                <div class="font-weight-bold p-2" >
                  Hora Inicial:       
                </div>
                <div class="font-weight-bold p-2" >
                  <input  name="timeI" id="timeI"  class="form-control rojo_obscuro color_rojo_suave ">
                </div>
                <div class="font-weight-bold p-2 ml-3" >
                  Hora Final:
                </div>          
                <div class="font-weight-bold p-2" >
                  <input  name="timeF" id="timeF"  class="form-control rojo_obscuro color_rojo_suave ">         
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-center m-3">
              <div class="font-weight-bold p-2">
                Mercancía a transportar:
              </div>
              <div class="font-weight-bold p-2">
                <form>
                  <select name="select_transportar" id="area_trabajo" class="p-2 color_rojo_suave rojo_obscuro font-weight-bold form-control" onchange="addNewReg('area_trabajo');">
                    <option value="Frutas y verduras" >Frutas y verduras</option>
                    <option value="Carnes">Carnes</option> 
                    <option value="Dulces">Dulces</option> 
                    <option value="Abarrotes">Abarrotes</option>
                    <option value="Medicinas">Medicinas</option>
                    <option value="Papeleria">Papeleria</option>
                    <option value="Chocolates">Chocolates</option>
                    <option value="Frituras">Frituras</option> 
                    <option value="Jugos">Jugos</option> 
                    <option value="Carnes frias y lacteos">Carnes frias y lacteos</option> 
                    <option value="Carga en general">Carga en general</option>
                    <option value="Abarrotes">Abarrotes</option>
                    <option value="Muebles en general">Muebles en general</option>
                    <option value="otros">Otros</option>              
                  </select>
                </form>
              </div>
              <div class="font-weight-bold p-2">
                <input type="text" name="otro" class="form-control rojo_obscuro color_rojo_suave" placeholder="Inserte otro" id="otra">
              </div> 
              <div class="font-weight-bold p-2" id="divKilo">
                Kilometraje Inicial
              </div>    
              <div class="font-weight-bold p-2" id="div2kilo">           
                <input type="text" name="kilometraje" id="kilometraje" class="form-control rojo_obscuro color_rojo_suave">             
              </div> 
              <div class="font-weight-bold mt-3 mr-2" id="divCosto">
                Costo
              </div>    
              <div class="font-weight-bold mt-3" id="divCosto2">
                $
              </div> 
              <div class="font-weight-bold p-2" id="divInputCosto">           
                <input type="text" name="costo" id="costo" class="form-control rojo_obscuro color_rojo_suave" >             
              </div>                 
            </div>
            <div class="d-flex justify-content-center m-3">
              <div class="font-weight-bold mt-3 mr-2 " id="divMoDe">
                Monto del Deposito
              </div>    
               <div class="font-weight-bold p-2" id="divMoDeI">           
                <input type="text" name="monto_deposito" id="monto_deposito" class="form-control rojo_obscuro color_rojo_suave">             
              </div> 
              <div class="font-weight-bold mt-3 mr-2" id="divVaPa">
                Valor del Pagaré $
              </div>
              <div class="font-weight-bold p-2" id="divVaPaI">           
                <input type="text" name="valor_pagare" id="valor_pagare" class="form-control rojo_obscuro color_rojo_suave" >             
              </div>
            </div>
            <div class="d-flex justify-content-center m-3">
              <!-- <a href="#" type="button" class="btn btn-dark btn-lg m-3 rojo_obscuro_btn">
              Generar Documento</a>-->
              <?php if($row2['idrol']==3){ ?>
                <button type="submit" name="add_servicios"  class="btn btn-dark btn-lg m-3 rojo_obscuro_btn" value="finalizarOrden" id="finalizarOrden" > Guardar</button>
                <button type="submit"   class="btn btn-dark btn-lg m-3 rojo_obscuro_btn" value="generardocumento" id="generardocumento" > Generar Documento</button>
              <?php }?>
            </div>
            <!-- termina seguda columna
            </form>--> 
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
  </div>       
  <!--<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>-->
  <!--<script src="../content/js/jquery-ui.min.js"></script>-->
  <script>
      $(document).ready(function(){
          $('#timeI').timepicker({
              timeFormat: 'HH:mm',
              interval: 30, 
          });
      });

      $(document).ready(function(){
          $('#timeF').timepicker({
              timeFormat: 'HH:mm',
              interval: 30, 
          });
      });


      $(document).ready(function(){
          $('#timeR').timepicker({
              timeFormat: 'HH:mm',
              interval: 30, 
          });
      });

      $(document).ready(function(){
          $('#timeC').timepicker({
              timeFormat: 'HH:mm',
              interval: 30, 
          });
      });

    $("#kilometraje").on({
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
    $("#monto_deposito").on({
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
    $("#valor_pagare").on({
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
    $( "#otra" ).hide();
    divC = document.getElementById("contenedorFlete");
    divC.style.display = "none";
    function addNewReg(select){
      var option = $("#"+select).val();
      if(option=="otros"){ 
        $( "#otra" ).show();
      }
      if(option!="otros"){ 
        $( "#otra" ).hide();
      }
    }
    function pagoOnChange(sel) {
      var options = $("#"+sel).val();
      if (options=="1"){
          divC = document.getElementById("contenedorFlete");
          divC.style.display = "block";
          divC1 = document.getElementById("divKilo");
          divC1.style.display = "block";
          divC2 = document.getElementById("div2kilo");
          divC2.style.display = "block";
          divC3 = document.getElementById("divFI1");
          divC3.style.display = "block";
          divC4 = document.getElementById("divFI2");
          divC4.style.display = "block";
          divC5 = document.getElementById("divhora");
          divC5.style.display = "none";

          divC6 = document.getElementById("fecha_Total");
          divC6.style.display = "block";
          divC7 = document.getElementById("divFT");
          divC7.style.display = "block";
          buttonGenerar = document.getElementById("generardocumento");
          buttonGenerar.style.display = "block";

          divC12 = document.getElementById("monto_deposito");
          divC12.style.display = "none";
          divC13 = document.getElementById("divMoDe");
          divC13.style.display = "none";

          divC14 = document.getElementById("divVaPa");
          divC14.style.display = "none";
          divC15 = document.getElementById("valor_pagare");
          divC15.style.display = "none";

          divC16 = document.getElementById("divCosto");
          divC16.style.display = "block";
          divC17 = document.getElementById("divCosto2");
          divC17.style.display = "block";
          divC18 = document.getElementById("divInputCosto");
          divC18.style.display = "block";
      }
      if (options!="1"){
        if(options=="3"){
          buttonGenerar = document.getElementById("generardocumento");
          buttonGenerar.style.display = "none";

          divC12 = document.getElementById("monto_deposito");
          divC12.style.display = "none";
          divC13 = document.getElementById("divMoDe");
          divC13.style.display = "none";

          divC1 = document.getElementById("divKilo");
          divC1.style.display = "none";
          divC2 = document.getElementById("div2kilo");
          divC2.style.display = "none";

          divC14 = document.getElementById("divVaPa");
          divC14.style.display = "none";
          divC15 = document.getElementById("valor_pagare");
          divC15.style.display = "none";

          divC16 = document.getElementById("divCosto");
          divC16.style.display = "none";
          divC17 = document.getElementById("divCosto2");
          divC17.style.display = "none";
          divC18 = document.getElementById("divInputCosto");
          divC18.style.display = "none";
        }else{
          buttonGenerar = document.getElementById("generardocumento");
          buttonGenerar.style.display = "block";

          divC12 = document.getElementById("monto_deposito");
          divC12.style.display = "block";
          divC13 = document.getElementById("divMoDe");
          divC13.style.display = "block";

          divC1 = document.getElementById("divKilo");
          divC1.style.display = "block";
          divC2 = document.getElementById("div2kilo");
          divC2.style.display = "block";

          divC14 = document.getElementById("divVaPa");
          divC14.style.display = "block";
          divC15 = document.getElementById("valor_pagare");
          divC15.style.display = "block";

          divC16 = document.getElementById("divCosto");
          divC16.style.display = "block";
          divC17 = document.getElementById("divCosto2");
          divC17.style.display = "block";
          divC18 = document.getElementById("divInputCosto");
          divC18.style.display = "block";
        }
          divC = document.getElementById("contenedorFlete");
          divC.style.display = "none";
          divC3 = document.getElementById("divFI1");
          divC3.style.display = "block";
          divC4 = document.getElementById("divFI2");
          divC4.style.display = "block";
          divC5 = document.getElementById("divhora");
          divC5.style.display = "block";
          divC6 = document.getElementById("fecha_Total");
          divC6.style.display = "block";
      }
    }

    /*function unidadOnChange(sel){
      var options = $("#"+sel).val();
      alert(options);
    }
    */
    // Función autocompletar
    function autocompletar() {
      var minimo_letras = 0; // minimo letras visibles en el autocompletar
      var rol = $('#rol').val();
      var palabra = $('#contacto').val();

      if(rol==1){
            if (palabra.length >= minimo_letras) {
            $.ajax({
              url: '../controller/colores1.php',
              type: 'POST',
              data: {palabra:palabra},
              success:function(data){
                $('#lista_contacto').show();
                $('#lista_contacto').html(data);
              }
            });
          } else {
            //ocultamos la lista
            $('#lista_contacto').hide();
          }
      }else{
        var suc = $('#ids').val();
        //Contamos el valor del input mediante una condicional
        if (palabra.length >= minimo_letras) {
          $.ajax({
            url: '../controller/colores.php',
            type: 'POST',
            data: {palabra:palabra,suc:suc},
            success:function(data){
              $('#lista_contacto').show();
              $('#lista_contacto').html(data);
            }
          });
        } else {
          //ocultamos la lista
          $('#lista_contacto').hide();
        }
      }
    }

    // Funcion Mostrar valores
    function set_item(opciones) {
      // Cambiar el valor del formulario input
      $('#contacto').val(opciones);
      // ocultar lista de proposiciones
      $('#lista_contacto').hide();
    }

    window.addEventListener("load", function() {
      kilometraje.addEventListener("keypress", soloNumeros, false);
    });
    window.addEventListener("load", function() {
      costo.addEventListener("keypress", soloNumeros, false);
    });

    //Solo permite introducir numeros.
    function soloNumeros(e){
      var key = window.event ? e.which : e.keyCode;
      if (key < 48 || key > 57) {
        e.preventDefault();
      }
    }
    
    const d = new Date();
    let today = new Date(d.getTime() - d.getTimezoneOffset() * 60 * 1000).toISOString().split('T')[0];

    //alert(today);
    document.getElementsByName("fecha_inicial")[0].setAttribute("min", today-1);
    document.getElementsByName("fecha_final")[0].setAttribute("min", today-1);


    $('#fecha_inicial').change(function(){
      const d = new Date();
      let today = new Date(d.getTime() - d.getTimezoneOffset() * 60 * 1000).toISOString().split('T')[0];
      var objFecha = new Date($("#fecha_inicial").val());
      if(objFecha.toISOString().split("T")[0] >= today){
        var ini  = objFecha.getUTCDate();
        //alert(objFecha.getUTCDate());
      }else{
        alert("Valide la Fecha Inicial");
        $("#fecha_inicial").val(today);
      }

      var final = objFecha.toISOString().split("T")[0];
      //alert(final);
      $("#fecha_final").val(final);

      var objFecha1 = new Date($("#fecha_final").val());
      var fin  = objFecha1.getUTCDate();
      //alert(objFecha1.getUTCDate());
      if($("#fecha_final").val()!=""){
            totalHoras(ini,fin);
          }
    });

    $('#fecha_final').change(function(){
      const d = new Date();
      let today = new Date(d.getTime() - d.getTimezoneOffset() * 60 * 1000).toISOString().split('T')[0];
      var objFecha = new Date($("#fecha_inicial").val());
      var ini  = objFecha.getUTCDate();
      

      var objFecha1 = new Date($("#fecha_final").val());
     
      if(objFecha1.toISOString().split("T")[0] >= objFecha.toISOString().split("T")[0] ){
        
        var fin  = objFecha1.toISOString().split("T")[0];
        //alert(fin);
      }else{
        alert("Valide la Fecha Final");
        $("#fecha_final").val(today);
        var objFecha2 = new Date($("#fecha_final").val());
        var fin  = objFecha2.getUTCDate();
      }
      var ini = objFecha.toISOString().split("T")[0];
      if($("#fecha_inicial").val()!=""){
        totalHoras(ini,fin);
      }
    });

    function totalHoras(ini,fin){
      //alert(ini+" - "+fin)
      var f1 = moment(ini).format('YYYY-MM-DD');
      var f2 = moment(fin).format('YYYY-MM-DD');

      var fecha1 = moment(f1);
      var fecha2 = moment(f2);

      var valor = fecha2.diff(fecha1, 'days');
    
      var b = document.getElementById("fecha_Total");
      b.setAttribute("value", valor);
    }
  </script>
  <script src="../content/js/funciones.js"></script>
  <script src="../content/js/bootstrap.min.js"></script>
</body>
</html>
