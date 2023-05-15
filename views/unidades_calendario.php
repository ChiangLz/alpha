<?php
  include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente
  require_once("../model/unidades.php");


  //se inicializar un array de 12 meses para guardar el dia que inicia cada mes
  $_SESSION['diaMes'] = array();
  for($z=1;$z<=12;$z++) $_SESSION["diaMes"] [$z] = 1;

 
  $col2= new consul();
  $detalleCol = $col2->nomcolaborador($_SESSION['idc']);
  $col6= new consul();
  $detalleFecha = $col6->fecha($_SESSION['ids']);
  $col3= new consul();
  $detalleSuc = $col3->nomsucursal($_SESSION['ids']);
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
  <div class="row">
    <div class="d-flex flex-row">
   <div class="d-flex flex-row">
      <div> 
        <div class="menu_lateral iconos_menu degradado ">
        <a href="unidades.php"><i class="fas fa-truck m-3 " data-toggle="tooltip" data-placement="right" title="Vehículos">
        </i></a>
        <a href="unidades_editar.php" ><i class="far fa-edit m-3 " data-toggle="tooltip" data-placement="right" title="Editar"></i></a>
        <a href="unidades_add.php" ><i class="far fa-plus-square m-3" data-toggle="tooltip" data-placement="right" title="Agregar"></i></a>
        
         <a href="unidades_calendario.php" ><i class="far fa-calendar m-3 active" data-toggle="tooltip" data-placement="right" title="Calendario"></i></a>
         <a href="unidades_baja.php" ><i class="fas fa-trash-alt m-3" data-toggle="tooltip" data-placement="right" title="Tirar"></i></a>
             
    </div>
  </div> 
      
      <!--Segunda columna-->
      <div class=""> 
        <div class="contenedor_cabezal  border_seccion bg-white">
          <div class="float-right m-3"><a href="menus_cuadros.php"><i class="fas fa-chevron-left rojo_obscuro fa-2x"></i></a></div>
          <h1 class="text-center rojo_obscuro titulo_seccion mt-3 mb-3">Calendario de la  Unidad </h1>

          <?php  foreach ($detalleSuc as $rowss) { ?>
          <input hidden  type="text" id="sucursal" value="<?php echo $rowss['id']; ?>">
           
           <?php }?>
         
      </div>
      <div class="text-white rojo_obscuro_btn">
      
              <input hidden class="restavalor" type="text" value="<?php echo (date ("m"));?>" >
              <input hidden class="restavaloranio" type="text" value="<?php echo (date ("Y"));?>" >
             
              <br>
        <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-1">
        <h3 class=" "> <a  class="atrs" id="atras" name="atras"> <i class="fas fa-chevron-left  "  style="color:white; height:10px; width:10px;"></i></a>  
        </h3>
        </div>

        <div class="col-md-2">
        <h3 class="price-cash"><?php  echo date ("F");?></h3> 
        </div>
        <div class="col-md-1">
        <h3 class=" "> <a  class="atrs" id="adelante" name="adelante"> <i class="fas fa-chevron-right  "  style="color:white; height:10px; width:10px;"></i></a>  
        </h3>
        </div>
       </div>

       <br>
      </div>
      <!-- comienza calendario-->


      <div class="row d-flex  m-2 p-2" id="calactual" >

      </div>

      <div class="row d-flex  m-2 p-2" id="caldepues" >
     
      </div>
     
      </div>
    </div>

    </div>
    
</div>
  </div>
</div>       

  <script src="../content/js/jquery-3.3.1.min.js"></script>
  <script src="../content/js/bootstrap.min.js"></script>
  <script>

$( document ).ready(function() {
    var fecha = new Date();
    var variableJS=fecha.getFullYear();
    $.ajax({
              type:"POST",
              url:"calendario.php",
              data: "consulta=calendar"+"&fechaActual=" + variableJS,
              success:function(response){
            
              $("#calactual").html(response);
              
                
              },
              
          });
});
      
      const button = document.querySelector('#button');
      const tooltip = document.querySelector('#tooltip');

      Popper.createPopper(button, tooltip);


      $('#cita').click(function(){
      window.location = 'calendario_detalle.php';
      });

      $('#atras').click(function(){
        var mesresta = parseInt($('.restavalor').val())-1;
        var anioresta = parseInt($('.restavaloranio').val())-1;
        meses(mesresta,anioresta);
   
      });

      $('#adelante').click(function(){
        var mesresta = parseInt($('.restavalor').val())+1;
        var anioresta = parseInt($('.restavaloranio').val())+1;
        meses(mesresta,anioresta);
  
      });

function meses(mesresta1,anioresta1){

  if(mesresta1<10){
    mesresta="0"+mesresta1;
    $('.restavalor').val(mesresta);
  }
  else{
    $('.restavalor').val(mesresta1);
  }

  if(mesresta1>12){
    mesresta1=1;
    $('.restavaloranio').val(anioresta1);
    $('.restavalor').val("0"+mesresta1);
  }
  if(mesresta1<1){
    mesresta1=12;
    $('.restavaloranio').val(anioresta1);
    $('.restavalor').val(mesresta1);
     variableJS = mesresta1;
  }

  if(mesresta1==12){
    $(".price-cash").text('December');
  }
  if(mesresta1==11){
    $(".price-cash").text('November');
  }
  if(mesresta1==10){
    $(".price-cash").text('October');
  }
  if(mesresta1==9){
    $(".price-cash").text('September');
  }

  if(mesresta1==8){
    $(".price-cash").text('August');
  }

  if(mesresta1==7){
    $(".price-cash").text('July');
  }
  if(mesresta1==6){
    $(".price-cash").text('June');
  }

  if(mesresta1==5){
    $(".price-cash").text('May');
  }

  if(mesresta1==4){
    $(".price-cash").text('April');
  }

  if(mesresta1==3){
    $(".price-cash").text('March');
  }

  if(mesresta1==2){
    $(".price-cash").text('February');
  }

  if(mesresta1==1){
    $(".price-cash").text('January');
  }
    $.ajax({
        type:"POST",
        url:"../controller/calendarioAntes.php",
        data: "consulta=atras"+"&valor=" + mesresta1 +"&fechaActual=" + $('.restavaloranio').val(),
        success:function(response){
      
        $("#caldepues").html(response);
          $("#calactual").remove();
        
          
        },
              
    });
}
    </script>
</body></html>
