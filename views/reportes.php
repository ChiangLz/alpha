<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente
require_once("../model/reportes.php");
//phpinfo();
if($_SESSION['rol']==="SuperAdministrador"){

  $col2= new consul();
$detalleCol = $col2->nomcolaborador($_SESSION['idc']);
$col3= new consul();
$detalleUni = $col3->unidad_sucursaladm();
$col4= new consul();
$detalleCli = $col4->cliente_sucursaladm($_SESSION['ids']);
$col5= new consul();
$detalleOrdenes = $col5->reportes_sucursalesadm();
$col6= new consul();
$detallesuc = $col6->nomsucursal($_SESSION['ids']);
}else{
  $col2= new consul();
  $detalleCol = $col2->nomcolaborador($_SESSION['idc']);
  $col3= new consul();
  $detalleUni = $col3->unidad_sucursal($_SESSION['ids']);
  $col4= new consul();
  $detalleCli = $col4->cliente_sucursal($_SESSION['ids']);
  $col5= new consul();
  $detalleOrdenes = $col5->reportes_sucursales($_SESSION['ids']);
  $col6= new consul();
  $detallesuc = $col6->nomsucursal($_SESSION['ids']);
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    
  </head>
 
  <body>
  


  <!-- Content here -->          
<div class="container border border-secondary">
  <div class="row bg-dark">
              <div class="col-md-4 d-none d-md-block"><img src="../content/imagenes/logo.png" alt="IRIS" class="logo_iris"></div>
              <div class="col-sm-6 col-md-4 text-center user_text"><?php foreach ($detalleCol as $row2) { ?> <span class="gris_claro">Bienvenido:</span> <?php echo $row2['cuenta']; ?> </div>  
              <div class="col-sm-6 col-md-4 iconos_menu ">
                <div class="text-center">
                <a href="menus_cuadros.php"><i class="fas fa-th"></i></a>
                
               
                <a href="#"><i class="fas fa-question-circle"></i></a>                                  
                </div>
              </div>   
  </div>
  <div class="row bg-info">
    <div class="d-flex flex-row">
      <div> 
        <div class="menu_lateral iconos_menu degradado">
        <a href="unidades.php"><i class="far fa-file m-3" data-toggle="tooltip" data-placement="right" title="Vehículos">
        </i></a>
        <a href="unidades_editar.php" ><i class="far fa-edit m-3" data-toggle="tooltip" data-placement="right" title="Editar"></i></a>
        <a href="unidades_editar.php" ><i class="far fa-plus-square m-3" data-toggle="tooltip" data-placement="right" title="Agregar"></i></a>
         
         <a href="unidades_calendario.php" ><i class="far fa-calendar m-3" data-toggle="tooltip" data-placement="right" title="Calendario"></i></a>
        <a href="#" ><i class="fas fa-trash-alt m-3" data-toggle="tooltip" data-placement="right" title="Tirar"></i></a> 
             
    </div>
  </div> 
      
      <!--Segunda columna-->
      <div class="bg-white"> 
        <div class="contenedor_cabezal  border_seccion">
        <h1 class="text-center rojo_obscuro titulo_seccion mt-3">Listado de Reportes </h1>
         <div class="d-flex m-2">
           <div class="text-white bg-dark box_circule rounded-circle m-2"> <i class="far fa-file m-4"></i></div>        
           <h4 class=" py-3">Reportes</h4>
           <?php foreach($detallesuc as $rows){?>
           <input hidden type="text" id="suc" name="suc" value="<?php echo $rows['idsuc']?>">
           <?php }?>
         </div>
         <div class="row " style="float: right;position: relative; bottom:30px;">
         <input name="pago1" class="pago ml-4 " type="radio" style="width: 20px; height: 20px" value="anterior"/><strong>Año Anterio</strong>
        <input checked="checked" class="pago ml-4 " name="pago1" type="radio" style="width: 20px; height: 20px" value="actual"/><strong class="mr-4"> Año Actual</strong>
         </div>
      </div>
      <div class="p-2">
      
        <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center"> NOMBRE DEL REPORTE</th>
                  <th scope="col" class="text-center">
                  <select name="select_cliente" id="select_cliente" onchange="clienteOnChange('select_cliente');" class="p-2 color_rojo_suave rojo_obscuro font-weight-bold form-control">
                    <option value=""> Cliente</option>
                    <?php foreach($detalleCli as $rowC){?>
          <option value="<?php echo $rowC['idc']?>"><?php echo $rowC['nomcli']?></option>
          <?php }  ?>                    
                </select>
              </th>
                <th>
                  <select name="select_unidad" id="select_unidad" onchange="unidadOnChange('select_unidad');" class="p-2 color_rojo_suave rojo_obscuro font-weight-bold form-control">
                    <option value="">Vehículo</option>
                    <?php foreach($detalleUni as $rowU){?>
          <option value="<?php echo $rowU['noserie']?>"><?php echo $rowU['nomuni']?></option>
          <?php }  ?>                   
                </select>
                </th>
                  <th scope="col" class="text-center">
                 
           
                    <div id="anioAcutal" style="display:;" >
                    <p>Fecha Inicial</p>
                   <input type="date" class="form-control rojo_obscuro color_rojo_suave " id="fIni">

                    </div>

                    <div id="anioanterior" style="display:none;" >
                    <p>Fecha Inicial</p>
                   <input type="month" class="form-control rojo_obscuro color_rojo_suave " id="fMes">

                    </div>
                
                  
        

                  </th>
                  <th>
                 
            
            <div id="anioAcutal1" style="display:;">
                   <p>Fecha Final</p>
                     <input type="date" class="form-control rojo_obscuro color_rojo_suave " id="fFin">
                     </div>
                  </th>
                </tr>
              </thead>
              <tbody id="tablaCarga">
              <?php foreach ($detalleOrdenes as $row) { ?>
                
              
                <tr class="color_rojo_suave" >
                  <td class="text-center" ><a href="reportes_detalles.php?idr=<?php echo $row['ido']; ?>" class="rojo_obscuro"><i class="fas fa-eye"></i></a></td>
                  <td class="text-center"> <a  class="rojo_obscuro"><?php echo $row['tipo']; ?></a> </td>
                  <td class="text-center">
                    <p><?php echo $row['nomcli']; ?></p></td>
                  <td class="text-center">
                    <p><?php echo $row['nomuni']; ?></p>
                  </td>
                   <td class="text-center">
                    <p><?php echo $row['fecha_inicial']; ?></p>
                </td>
                <td class="text-center">
                
                  <p><?php echo $row['fecha_final']; ?></p>
                 <!-- <a class=" text-white rojo_obscuro_btn btn-dark btn btn-primary" href="../controller/generarExcel.php?ids=<?php echo $rows['idsuc']; ?>" role="button"> Descargar <i class="fas fa-file-excel"></i></a>-->
                
                </td>
                </tr>
                <?php } ?> 
              </tbody>
              <tbody id="tablaClient"></tbody>
            </table>

          <input hidden id="myInputcli" type="text" >
         <?php if($row2['idrol']==3){?>
          <div class="row">
          <div class="col-md-6"></div>
              <div class="col-md-3">
                  <select name="reporteCliente" id="reporteCliente" class="p-2 color_rojo_suave rojo_obscuro font-weight-bold form-control">
                        <option value="">Reporte Cliente</option> 
                        <option value="clientes">Listado General de Clientes</option>  
                        <option value="servicios">Listado de Servicios contratados</option>                       
                  </select>
              </div>
              <div class="col-md-3">
                  <select name="reporteUnidad" id="reporteUnidad"  class="p-2 color_rojo_suave rojo_obscuro font-weight-bold form-control">
                        <option value="">Reporte Vehículo</option> 
                        <option value="unidad">Listado General de Unidades</option> 
                        <option value="ventas">Listado de Servicios (ventas)</option>  
                        <option value="gastos">Listado de Gastos generados</option>           
                  </select>
              </div>
              
          </div>
         <?php }elseif($row2['idrol']==2){?>
          <div class="row">
          <div class="col-md-6"></div>
              <div class="col-md-3">
                  <select name="reporteCliente" id="reporteCliente" class="p-2 color_rojo_suave rojo_obscuro font-weight-bold form-control">
                        <option value="">Seleccione una opción</option> 
                        <option value="rentaCliente">Listado Rentabilidad de Clientes</option>                          
                  </select>
              </div>
              <div class="col-md-3">
                  <select name="reporteUnidad" id="reporteUnidad" class="p-2 color_rojo_suave rojo_obscuro font-weight-bold form-control">
                        <option value="">Seleccione una opción</option> 
                        <option value="compraVenta">Reporte Compra Venta</option>
                        <option value="rentaUnidad">Listado Rentabilidad de Unidades</option>                      
                  </select>
              </div>
          </div>
         <?php }?>
      </div>
     

      <!-- termina seguda columna-->
      </div>
    

    </div>
   
              <?php }?>



    </div>
    



  






  </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="../content/js/funciones.js"></script>
  <script src="../content/js/bootstrap.min.js"></script>
  <script>
     
      $(".pago").click(function(evento){
          
          var valor = $(this).val();
        
          if(valor == 'actual'){
              $("#anioAcutal").css("display", "block");
              $("#anioAcutal1").css("display", "block");
              $("#anioanterior").css("display", "none");
          }else{
              $("#anioAcutal").css("display", "none");
              $("#anioAcutal1").css("display", "none");
              $("#anioanterior").css("display", "block");
          }
  });

  function clienteOnChange(cli) {
   options = $("#"+cli).val();
  
   
    $.ajax({
            type:"POST",
            url:"../controller/table_report.php",
            data: "consutla=cliente"+"&idc=" + $("#"+cli).val() ,
            success:function(response){
              $("#tablaClient").html(response);
              $("#tablaCarga").remove();
              //$("#Exportar").attr("href","../controller/generarExcel.php?tip=cliente&idc="+options)
              $('#myInputcli').val(options);
            },
            
        });
   
}
function unidadOnChange(uni) {
  options = $("#"+uni).val();
    $.ajax({
            type:"POST",
            url:"../controller/table_report.php",
            data: "consutla=unidad"+"&idu=" + $("#"+uni).val() ,
            success:function(response){
              $("#tablaClient").html(response);
              $("#tablaCarga").remove();
             // $("#Exportar").attr("href","../controller/generarExcel.php?tip=unidad&idu="+options)
            },
            
        });
   
}

$('#fMes').change(function(){
        var mes = $("#fMes").val();
      // alert(mes);
        if($("#fMes").val()!=""){
        fechames(mes);
        }
});
function fechames(mes){
  $.ajax({
            type:"POST",
            url:"../controller/table_report.php",
            data: "consutla=fechames"+"&fmes=" + mes,
            success:function(response){
              $("#tablaClient").html(response);
              $("#tablaCarga").remove();
              //alert(response);
              //$("#Exportar").attr("href","../controller/generarExcel.php?tip=cliente&idc="+options)
              //$('#myInputcli').val(options);
            },
            
        });

}

$('#fIni').change(function(){
  var ini = $("#fIni").val();
//  alert(ini);
  var fin =$("#fFin").val();
  // alert(fin);

  var seluni =$("#select_unidad").val();

  var selcli =$("#select_cliente").val();
 
  /*if($("#fFin").val()!=""&& $("#fFin").val()!=""){
    fecharango(ini,fin);
  }*/
  if($("#fFin").val()!="" && $("#select_unidad").val()!=""){
    fecharangoUnidad(ini,fin,seluni);
  }
  if($("#fFin").val()!="" && $("#select_cliente").val()!=""){
    fecharangoUnidad(ini,fin,selcli);
  }
});
$('#fFin').change(function(){
        var ini = $("#fIni").val();
      //  alert(ini);
        var fin =$("#fFin").val();

        var seluni =$("#select_unidad").val();

  var selcli =$("#select_cliente").val();
 
     //  alert(fin);
       /* if($("#fIni").val()!=""){
          fecharango(ini,fin);
        }*/
        if($("#fIni").val()!="" && $("#select_unidad").val()!=""){
    fecharangoUnidad(ini,fin,seluni);
  }
  if($("#fIni").val()!="" && $("#select_cliente").val()!=""){
    fecharangoUnidad(ini,fin,selcli);
  }
        
      });

function fecharango(ini,fin){
  $.ajax({
            type:"POST",
            url:"../controller/table_report.php",
            data: "consutla=fechaRango"+"&fini=" + ini+"&ffin=" + fin,
            success:function(response){
              $("#tablaClient").html(response);
              $("#tablaCarga").remove();
              //$("#Exportar").attr("href","../controller/generarExcel.php?tip=cliente&idc="+options)
              //$('#myInputcli').val(options);
            },
            
        });

}
function fecharangoUnidad(ini,fin,seluni){
  $.ajax({
            type:"POST",
            url:"../controller/table_report.php",
            data: "consutla=fechaRangoUnidad"+"&fini=" + ini+"&ffin=" + fin+"&uni=" + seluni,
            success:function(response){
              $("#tablaClient").html(response);
              $("#tablaCarga").remove();
              //$("#Exportar").attr("href","../controller/generarExcel.php?tip=cliente&idc="+options)
              //$('#myInputcli').val(options);
            },
            
        });

}
function fecharangoCliente(ini,fin,selcli){
  $.ajax({
            type:"POST",
            url:"../controller/table_report.php",
            data: "consutla=fechaRangoCliente"+"&fini=" + ini+"&ffin=" + fin+"&cli=" + selcli,
            success:function(response){
              $("#tablaClient").html(response);
              $("#tablaCarga").remove();
              //$("#Exportar").attr("href","../controller/generarExcel.php?tip=cliente&idc="+options)
              //$('#myInputcli').val(options);
            },
            
        });

}
      $('#reporteCliente').change(function(){
        var rcli = $("#reporteCliente").val();
        var suc = $("#suc").val();
        var cliente = $("#select_cliente").val();
        var fechaini = $("#fIni").val();
        var fechafin = $("#fFin").val();
        
        if(rcli!=""){
          if(rcli=="clientes"){
          
           window.open('../controller/excelCliente.php?suc='+suc,'_blank'); 
               
         }

         if(cliente!="" &&fechaini!="" &&fechafin!=""){
              if(rcli=="servicios"){
                
                window.open('../controller/excelServicosContratados.php?suc='+suc+'&cliente='+cliente+'&fechaini='+fechaini+'&fechafin='+fechafin,'_blank'); 
                    
              }
              if(rcli=="rentaCliente"){
                window.open('../controller/excelRenta_cliente.php?suc='+suc+'&cliente='+cliente+'&fechaini='+fechaini+'&fechafin='+fechafin,'_blank'); 
              }
         }else{
                alert("Por favor seleccione un cliente, fecha de inicio y fecha final para obtener los datos...");
              }
         
        }
        
      });

      $('#reporteUnidad').change(function(){
        var runi = $("#reporteUnidad").val();
        var suc = $("#suc").val();
        var unidad = $("#select_unidad").val();
        var fechaini = $("#fIni").val();
       
        var fechafin = $("#fFin").val();

        if(runi!=""){
          if(runi=="unidad"){
                      
                      window.open('../controller/excelUnidad.php?suc='+suc,'_blank'); 
                          
                    }

              if(unidad!=""){
                      
                    if(runi=="gastos"){
                      if(fechaini!="" &&fechafin!=""){
                        window.open('../controller/excelGastos.php?suc='+suc+'&uni='+unidad+'&fechaini='+fechaini+'&fechafin='+fechafin,'_blank'); 
                      }else{
                        alert("Por favor seleccione una fecha de inicio y una fecha de fin")
                      }   
                    }
                    if(runi=="ventas"){
                      if(fechaini!="" &&fechafin!=""){
                        window.open('../controller/excelVentas.php?suc='+suc+'&uni='+unidad+'&fechaini='+fechaini+'&fechafin='+fechafin,'_blank'); 
                      }else{
                        alert("Por favor seleccione una fecha de inicio y una fecha de fin")
                      }
                    }
                    if(runi=="rentaUnidad"){
                      if(fechaini!="" &&fechafin!=""){
                        window.open('../controller/excelRenta_unidad.php?suc='+suc+'&uni='+unidad+'&fechaini='+fechaini+'&fechafin='+fechafin,'_blank'); 
                      }else{
                        alert("Por favor seleccione una fecha de inicio y una fecha de fin")
                      }
                    }
                    if(runi=="compraVenta"){
                      window.open('../controller/excelCompraVenta.php?suc='+suc+'&uni='+unidad,'_blank'); 
                    }

              }else{
                alert("Por favor seleccione una unidad");
              }
        }
        
      });

      $('#reporteRenta').change(function(){
        var renta = $("#reporteRenta").val();
        var suc = $("#suc").val();
        var suc = $("#suc").val();
        var unidad = $("#select_unidad").val();
        var cliente = $("#select_cliente").val();
        var fechaini = $("#fIni").val();       
        var fechafin = $("#fFin").val();
        //alert("renta: "+renta+" --suc: "+suc+" --cliente: "+cliente+" --fechaini: "+fechaini+" --fechafin: "+fechafin+" --unidad: "+unidad);

       /* if(renta=="rentaUnidad"){
                alert("Entre 2");
                      window.open('../controller/excelRenta_unidad.php?suc='+suc+'&cliente='+cliente+'&uni='+unidad+'&fechaini='+fechaini+'&fechafin='+fechafin,'_blank'); 
                          
              }*/

      if(renta!=""){

         if(cliente!="" &&fechaini!="" &&fechafin!=""){ //Reportes Especificos 
              if(renta=="rentaUnidad"){
                window.open('../controller/excelRenta_unidad.php?suc='+suc+'&cliente='+cliente+'&uni='+unidad+'&fechaini='+fechaini+'&fechafin='+fechafin,'_blank'); 
                          
              }
              if(renta=="rentaCliente"){
                window.open('../controller/excelRenta_cliente.php?suc='+suc+'&cliente='+cliente+'&uni='+unidad+'&fechaini='+fechaini+'&fechafin='+fechafin,'_blank'); 
              }

        }else{
          alert("Por favor seleccione un cliente, fecha de inicio y fecha final para obtener los datos...");
        }
      }
        
      });

    </script>

    




</body></html>  