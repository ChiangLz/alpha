<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente
require_once("../model/calendarios.php");
$fechasDatos = $_GET['fechaDatos'];
$fechas = $_GET['fecha'];
$col2= new consul();
$detalleCol = $col2->nomcolaborador($_SESSION['idc']);
$col3= new consul();
$detalleActiFecha = $col3->calendario_actividad($fechasDatos, $_SESSION['ids']);
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
                <span class="gris_claro">
                Bienvenido:</span>  <?php echo $row2['cuenta']; ?> </div> 
                <?php } ?>
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
        
         <a href="unidades_calendario.php" ><i class="far fa-calendar m-3 active" data-toggle="tooltip" data-placement="right" title="Calendario"></i></a>
        
             
    </div>
  </div> 
      
      <!--Segunda columna-->
      <div class=""> 
        <div class="contenedor_cabezal  border_seccion bg-white">
          <div class="float-right m-3"><a href="unidades_calendario.php"><i class="fas fa-chevron-left rojo_obscuro fa-2x"></i></a></div>
          <h1 class="text-center rojo_obscuro titulo_seccion mt-3 mb-3">Calendario de la  Unidad </h1>
          <h3 class="text-center m-3 p-2 ">Listado de eventos </h3>
         
      </div>
      <div class="text-white rojo_obscuro_btn">
        <div><h3 class="text-center p-3"><?php echo date("F", strtotime("$fechasDatos"));?></h3></div>

      </div>
      <!-- comienza calendario-->

      <div class="d-flex justify-content-center">
      <!-- <button class="btn btn-primary m-2" id="plus_evento"> <i class="fas fa-plus-circle fa-lg "></i> Añadir Evento</button>-->
      </div>
      <div class="d-flex flex-column m-2 p-2">

      <?php foreach ($detalleActiFecha as $row3) { 
        if($row3['idserv']==1 || $row3['idserv']==2){?>
        <div class="card text-white bg-danger mb-3">

      <?php } if($row3['idserv']==3){?>
        <div class="card text-white bg-warning mb-3">
      <?php } if($row3['idserv']==4){?>
        <div class="card text-white bg-primary mb-3">
       <?php }?>
                    <div class="card-header d-flex justify-content-between">
                            <div class="p-2"><i class="far fa-calendar fa-lg"  title="Calendario"></i> 
                            <?php echo $fechasDatos; ?>
                            </div>
                          <div class="d-flex">
                        <!-- <div><a href="#" class="text-white"> <i class="fas fa-edit p-2"></i></a></div>
                            <div><a id="eliminar" class="text-white"><i class="fas fa-times p-2"></i></a></div--->
                          </div>
                    </div>
                     
                   <?php if($row3['idserv']==4){
                      $idun=$row3['iduni'];
                      $idse=$row3['idserv'];
                      $fi=$row3['fechaini'];
                      $ff=$row3['fechafin'];
                      
                     
                      $colCalSer= new consul();
                      $detalleCalMant = $colCalSer->calendario_mate($idun,$idse,$fi,$ff);
                      foreach ($detalleCalMant as $rowcm){
                      ?>

                                <input type="text" id="uni_id" value="<?php echo $rowcm['noserie']; ?>" class="form-control p-2 mt-3" hidden>
                                <input type="date" id="fecha_inicial" value="<?php echo $rowcm['fecha_inicio']; ?>" class="form-control p-2 mt-3" hidden>
                                <input type="date" id="fecha_fin" value="<?php echo $rowcm['fecha_final']; ?>" class="form-control p-2 mt-3" hidden>
                                <input type="date" id="tipo_servicio" value="<?php echo $rowcm['id']; ?>" class="form-control p-2 mt-3" hidden>


                                <div class="card-body bg-light text-dark">

                                <h5 class="card-title"><?php echo $rowcm['tipo']; ?>  </h5>
                                <p class="card-text"> Mantenimiento  a la unidad <?php echo $rowcm['nomuni']; ?>, 
                                marca: <?php echo $rowcm['marca']; ?> , model: <?php echo $rowcm['modelo']; ?>, numero de serie: <?php echo $rowcm['noserie']; ?>. 
                                Fecha del mantenimiento del <?php echo $rowcm['fecha_inicio']; ?>  al <?php echo $rowcm['fecha_final']; ?> . Dicho mantenimiento genera un gasto de 
                                $<?php echo $rowcm['gastos']; ?>. Descripción del mantenimineto: <?php echo $rowcm['descripcion']; ?>.
                                para el cliente , con el numero de celular:  . 
                                </p>
                              </div>

                    <?php 
                    }  
                } else {
                    $idun=$row3['iduni'];
                    $idse=$row3['idserv'];
                    $fi=$row3['fechaini'];
                    $ff=$row3['fechafin'];
                    $idcli=$row3['idclient'];
                    $estado=$row3['estado']
                  ?>
                    <input type="text" id="uni_id" value="<?php echo $idun; ?>" class="form-control p-2 mt-3" hidden>
                    <input type="text" id="fecha_inicial" value="<?php echo $fi; ?>" class="form-control p-2 mt-3" hidden>
                    <input type="text" id="fecha_fin" value="<?php echo $ff; ?>" class="form-control p-2 mt-3" hidden>
                    <input type="text" id="tipo_servicio" value="<?php echo $idse; ?>" class="form-control p-2 mt-3" hidden>
                    <input type="text" id="cliente" value="<?php echo $idcli; ?>" class="form-control p-2 mt-3" hidden>
                  <?php
                    $colCalSer= new consul();
                    $detalleCalServ= $colCalSer->calendario_servi_all($fi,$ff, $idun, $_SESSION['ids']);
                    foreach ($detalleCalServ as $rowcs){
                   ?>
                      <div class="card-body bg-light text-dark">
                      <h5 class="card-title"><?php echo $rowcs['tips']; ?>  </h5>
                      <p class="card-text"> Datos de la Unidad: Nombre: <?php echo $rowcs['nomuni']; ?>, Marca:<?php echo $rowcs['marca']; ?>, Modelo:<?php echo $rowcs['modelo']; ?>, Numero Serie:<?php echo $rowcs['noserie']; ?>, 
                      Placas:<?php echo $rowcs['placas']; ?>. Datos Cliente: Nombre:<?php echo $rowcs['nomcli']; ?>, Telefono:<?php echo $rowcs['celular']; ?>. Datos de Entrega: 
                      Fecha Inicial:<?php echo $rowcs['fecha_inicial']; ?>, Fecha Final:<?php echo $rowcs['fecha_final']; ?>, Dirección:<?php echo $rowcs['dirrecoleccion']; ?> . 
                      </p>
                      <?php  if($rowcs['ids']==1){?>
                        <a href="../controller/ordenServicioEditar.php?idc=<?php echo $rowcs['idc'];?>&idu=<?php echo $rowcs['noserie'];?>&fi=<?php echo $rowcs['fecha_inicial'];?>" target="_blank" type="button" class="btn btn-secondary">
                     <i class="fas fa-file "></i>
                   Documento</a> <!--Flete -->
                   <?php if($estado != "finalizado"){ ?>
                    <a class="btn btn-success text-white finalizar" uni_id="<?php echo $idun; ?>" fecha_inicial="<?php echo $fi; ?>" fecha_fin="<?php echo $ff; ?>" tipo_servicio="<?php echo $idse; ?>" cliente="<?php echo $idcli; ?>" style="cursor:pointer;"> Finalizar </a>
                   <?php } ?>
                   <a class="eliminar btn btn-danger text-white" uni_id="<?php echo $idun; ?>" fecha_inicial="<?php echo $fi; ?>" fecha_fin="<?php echo $ff; ?>" tipo_servicio="<?php echo $idse; ?>" cliente="<?php echo $idcli; ?>" style="cursor:pointer;"> Cancelar </a>


                      <?php }if($rowcs['ids']==2){?>

                      <a href="../controller/contratoServicioEditar.php?idc=<?php echo $rowcs['idc'];?>&idu=<?php echo $rowcs['noserie'];?>&fi=<?php echo $rowcs['fecha_inicial'];?>" target="_blank" type="button" class="btn btn-secondary">
                     <i class="fas fa-file"></i>
                   Documento</a> <!--Renta -->
                   <?php if($estado != "finalizado"){ ?>
                      <a class="btn btn-success text-white finalizar" uni_id="<?php echo $idun; ?>" fecha_inicial="<?php echo $fi; ?>" fecha_fin="<?php echo $ff; ?>" tipo_servicio="<?php echo $idse; ?>" cliente="<?php echo $idcli; ?>" style="cursor:pointer;"> Finalizar </a>
                   <?php } ?>
                   <a class="eliminar btn btn-danger text-white" uni_id="<?php echo $idun; ?>" fecha_inicial="<?php echo $fi; ?>" fecha_fin="<?php echo $ff; ?>" tipo_servicio="<?php echo $idse; ?>" cliente="<?php echo $idcli; ?>" style="cursor:pointer;"> Cancelar </a>
                     <?php }?>

                      
                      </div>

                 <?php } ?>
              
                  
                   <?php }?>
       </div>
      <?php } ?>    
        

  </div>



      <!-- termina calendario-->
     
      


      <!-- termina seguda columna-->
      </div>
    

    </div>
   
 



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

      $('#editar_evento').hide();

      $('#plus_evento').click(function(){
         $('#editar_evento').fadeIn();
      });

       $('#close_editar').click(function(){
         $('#editar_evento').hide();
      });

      $('.eliminar').click(function(){
        var uni_id =$(this).attr('uni_id');
        var fecha_inicial =$(this).attr('fecha_inicial');
        var fecha_fin =$(this).attr('fecha_fin');
        var tipo_servicio =$(this).attr('tipo_servicio');
        var cliente =$(this).attr('cliente');


        //alert("id: "+uni_id+" fechaI: "+fecha_inicial+" fechaF: "+fecha_fin+"tipo: "+tipo_servicio+"client: "+cliente);
        
        var mensaje = confirm("¡Esta apunto de Eliminar el servicio! ¿DESEA CONTINUAR?");
        if(mensaje) {
          if(tipo_servicio==4){
            $.ajax({
                    type:"POST",
                    url:"../controller/deleted_servicio.php",
                    data: "deleted_calendario=deleted_calendario"+"&uni_id=" + uni_id + "&fecha_inicial=" + fecha_inicial + 
                    "&fecha_fin="+ fecha_fin +"&tipo_servicio=" + tipo_servicio,
                    success:function(response){
                       alert(response);
                       window.location.href = '../views/unidades_calendario.php';
                    },
                    
                });
            
          }else{
            $.ajax({
                    type:"POST",
                    url:"../controller/deleted_servicio.php",
                    data: "deleted_calendario=deleted_calendario"+"&uni_id=" + uni_id + "&fecha_inicial=" + fecha_inicial + 
                    "&fecha_fin="+ fecha_fin +"&tipo_servicio=" + tipo_servicio + "&cliente=" + cliente,
                    success:function(response){
                       alert(response);
                       window.location.href = '../views/unidades_calendario.php';
                    },
                    
                });
          }
        }else {
          alert("¡No se elimino el servicio!");
        }
      
      });

      $('.finalizar').click(function(){
        var uni_id =$(this).attr('uni_id');
        var fecha_inicial =$(this).attr('fecha_inicial');
        var fecha_fin =$(this).attr('fecha_fin');
        var tipo_servicio =$(this).attr('tipo_servicio');
        var cliente =$(this).attr('cliente');


        //alert("id: "+uni_id+" fechaI: "+fecha_inicial+" fechaF: "+fecha_fin+"tipo: "+tipo_servicio+"client: "+cliente);
        
        var mensaje = confirm("¡Esta apunto de Finalizar el servicio! ¿DESEA CONTINUAR?");
        if(mensaje) {
          if(tipo_servicio==4){
            $.ajax({
                    type:"POST",
                    url:"../controller/finalizar_servicio.php",
                    data: "finalizar_calendario=finalizar_calendario"+"&uni_id=" + uni_id + "&fecha_inicial=" + fecha_inicial + 
                    "&fecha_fin="+ fecha_fin +"&tipo_servicio=" + tipo_servicio,
                    success:function(response){
                       alert(response);
                       window.location.href = '../views/unidades_calendario.php';
                    },
                    
                });
            
          }else{
            $.ajax({
                    type:"POST",
                    url:"../controller/finalizar_servicio.php",
                    data: "finalizar_calendario=finalizar_calendario"+"&uni_id=" + uni_id + "&fecha_inicial=" + fecha_inicial + 
                    "&fecha_fin="+ fecha_fin +"&tipo_servicio=" + tipo_servicio + "&cliente=" + cliente,
                    success:function(response){
                       alert(response);
                       window.location.href = '../views/unidades_calendario.php';
                    },
                    
                });
          }
        }else {
          alert("¡No se finalizo el servicio!");
        }
      
      });

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