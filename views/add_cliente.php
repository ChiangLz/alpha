<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente
require_once("../model/clientes.php");
$col3= new consul();
$detalleSuc = $col3->nomsucursal($_SESSION['ids']);
$col2=new consul();
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
   
      <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- jQuery timepicker library -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
  
  
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <link rel="stylesheet" href="../content/js/popper.min.js">
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <link href="../content/css/jquery-ui.css" type="text/css" rel="stylesheet"/>
    
  </head>
 
  <body>
  


  <!-- Content here -->          
<div class="container border border-secondary">
  <div class="row bg-dark">
              <div class="col-md-4 d-none d-md-block"><img src="../content/imagenes/logo.png" alt="IRIS" class="logo_iris"></div>
              <div class="col-sm-6 col-md-4 text-center user_text"> <?php foreach ($detalleCol as $row2) { ?>
               <span class="gris_claro">Bienvenido:</span> <?php echo $row2['cuenta']; } ?></div>  
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
          <a href="clientes.php"><i class="fas fa-suitcase m-3 " data-toggle="tooltip" data-placement="right" title="Clientes">
        </i>
        </a>
        <a href="add_cliente.php"><i class="far fa-plus-square m-3 " data-toggle="tooltip" data-placement="right" title="Clientes">
        </i>
        </a>
        
    </div>
  </div>      
      <!--Segunda columna-->
      <div class=""> 
        <div class="contenedor_cabezal  border_seccion bg-white mb-2">          
          <h1 class="text-center rojo_obscuro titulo_seccion mt-3 mb-2">Clientes Agregar Usuario</h1>    
      </div>
     

  

     <div class="d-flex justify-content-center p-3">
            <div class="border rounded p-3 text-center box_sucursal m-3">
              <i class="fas fa-user-cog fa-4x m-3 rojo_obscuro"></i>
              <p class=" h5"> Agregar Usuario:</p>
<!-- <form  action="../controller/add_cliente.php" class="text-dark p-3 needs-validation"  novalidate method="post" enctype="multipart/form-data">     -->
   <?php foreach ($detalleSuc as $row2) { ?>
         <input hidden type="text" name="idsuccli" id="idsuccli" value="<?php echo $row2['idsuc']; ?> ">
         <?php } ?>

        <div class="row">

          <div  class="col-md-12 " id="grupo__nombre">
            
            <p class="h4">Cliente persona física:</p>
             <div class="row ">
              <div class="col-md-6 p-2">
                <label for="name"> Nombre del contacto *</label>
                <input type="text"  name="contacto" id="contacto" class="form-control " onkeyup="mayusculas(this);" placeholder="Nombre" value="" required>
                 <div class="valid-feedback">
                        Correcto
                        </div>
                         <div class="invalid-feedback">
                        Por favor introduzca un nombre válido
                      </div>
                </div>
              <div class="col-md-6 p-2">
                <label for="email_contacto"> Email  *</label>
                <input type="email" class="form-control" placeholder="correo" name="correocont" id="correocont" value="" required>
                 <div class="valid-feedback">
                        Correcto
                        </div>
                         <div class="invalid-feedback">
                        Por favor introduzca un correo válido
                      </div>
              </div>              
            </div>
            <hr>
            <div class="row " style="">
            <input checked="checked" name="pago2" class="pago1 ml-4 p-2" type="radio" style="width: 20px; height: 20px" value="fisica"/> Persona Física
            <input  class="pago1 ml-5 " name="pago2" type="radio" style="width: 20px; height: 20px" value="moral"/> Persona Moral
            </div>

            <div id="representanteLegal" >
                  <div class="row">
                    <div class="col">
                      <p class="h3  mt-3">Representante Legal</p>
                    </div>
                  </div>

                  <div class="row ">
                    <div class="col-md-6 p-2">
                      <label for="name"> Nombre *</label>
                      <input type="text"  name="nomcli" id="nomcli" class="form-control " onkeyup="mayusculas(this);" placeholder="Nombre" value="" required>
                      <div class="valid-feedback">
                              Correcto
                              </div>
                              <div class="invalid-feedback">
                              Por favor introduzca un nombre válido
                            </div>
                      </div>
                    <div class="col-md-6 p-2">
                      <label for="telefono"> Telefono *</label>
                      <input type="text" class="form-control" placeholder="telefono" name="telcli" id="telcli" value="" required>
                      <div class="valid-feedback">
                              Correcto
                              </div>
                              <div class="invalid-feedback">
                              Por favor introduzca un puesto válido
                            </div>
                    </div>              
                  </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                      <label for="celular"> Celular * </label>
                      <input type="text" id="celular"  name="celular"class="form-control" placeholder="Telefono" value="" required>
                      <div class="valid-feedback">
                              Correcto
                              </div>
                              <div class="invalid-feedback">
                              Por favor introduzca un telefono válido
                            </div>
                    </div>             
                    <div class="col-md-6 p-2">
                      <label for="INE"> No. IFE (ahora INE) </label>
                      <input type="text" name="ine" id="ine"class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-2">
                      <label for="email"> Email *</label>
                      <input type="text"  name="correocli" id="correocli" class="form-control" placeholder="Email" value="" required>
                      <div class="valid-feedback">
                              Correcto
                              </div>
                              <div class="invalid-feedback">
                              Por favor introduzca un correo válido
                            </div>
                    </div>               
                    <div class="col m-2">
                      <label for="Orden de compra"> Dirección </label>
                      <input type="text"  name="dircli"  id="dircli" class="form-control" placeholder="Direcion"value="" >
                    </div>   
                </div>
                <div class="row">
                <div class="col-md-6 p-2">
                      <label for="txtRfc *">RFC * </label>
                      <input type="text" name="rfc1" id="rfc1" class="form-control" onkeyup="mayusculas(this);" value="" required placeholder="Ej.: MUJI701020ABC" />
                      <div class="valid-feedback">Correcto</div>
                      <div class="invalid-feedback">Por favor introduzca el RFC</div>
                      </div>

            </div>
                </div>
              </div>         
            </div>
            
            <div id="datosfacturacion" >
                                    <!-- empieza forma facturacion--->    
                          <p class="h3  mt-3">Datos de Facturación</p>

                      <div class="row">
                      <div class="col-md-6 p-2">
                      <label for="RazonSocial *">Razón Social *</label>
                      <input type="text" name="razonsocial" id="razonsocial" class="form-control" onkeyup="mayusculas(this);" placeholder="Ej.:Coca Cola" value="" required />
                      <div class="valid-feedback">Correcto</div>
                      <div class="invalid-feedback">Por favor introduzca la Razón Social</div>
                      </div>
                      <div class="col-md-6 p-2">
                      <label for="RazonSocial *">Dirección Fiscal *</label>
                      <input type="text" name="dirsocial" id="dirsocial" class="form-control" placeholder="Ej.:  Av. España #123" value="" required />
                      <div class="valid-feedback">Correcto</div>
                      <div class="invalid-feedback">Por favor introduzca Dirección de Facturación</div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-6 p-2">
                      <label for="txtColonia *">Colonia * </label>
                      <input type="text" name="colonia" id="colonia" class="form-control" onkeyup="mayusculas(this);"  value="" required  placeholder="Ej.: Fracc. Reforma" />
                      <div class="valid-feedback">Correcto</div>
                      <div class="invalid-feedback">Por favor introduzca la colonia</div>
                      </div>
                      <div class="col-md-6 p-2">
                      <label for="txtCiudad *">Ciudad *</label>
                      <input type="text" name="ciudad" id="ciudad" class="form-control" onkeyup="mayusculas(this);" value="" required placeholder="Ej.: Veracruz" />
                      <div class="valid-feedback">Correcto</div>
                      <div class="invalid-feedback">Por favor introduzca la Ciudad</div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-6 p-2">
                      <label for="txtEstado *">Estado * </label>
                      <input type="text" name="estado" id="estado" class="form-control" onkeyup="mayusculas(this);"  value="" required placeholder="Ej.: Veracruz" />
                      <div class="valid-feedback">Correcto</div>
                      <div class="invalid-feedback">Por favor introduzca el estado</div>
                      </div>
                      <div class="col-md-6 p-2">
                      <label for="txtCp *">Código Postal *</label>
                      <input type="text" name="cp" id="cp" class="form-control"  value="" required placeholder="Ej.: 91919" />
                      <div class="valid-feedback">Correcto</div>
                      <div class="invalid-feedback">Por favor introduzca el Código Postal</div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-md-6 p-2">
                      <label for="txtRfc *">RFC * </label>
                      <input type="text" name="rfc" id="rfc" class="form-control" onkeyup="mayusculas(this);" value="" required placeholder="Ej.: MUJI701020ABC" />
                      <div class="valid-feedback">Correcto</div>
                      <div class="invalid-feedback">Por favor introduzca el RFC</div>
                      </div>
                      <div class="col-md-6 p-2">
                            <label for="email2"> Telefono *</label>
                            <input type="text"  name="correofac" id="correofac"  class="form-control" placeholder="Telefono" value="" required>
                            <div class="valid-feedback">
                                    Correcto
                                    </div>
                                    <div class="invalid-feedback">
                                    Por favor introduzca un correo válido
                                  </div>
                          </div>      

                      </div>

            </div>


           

      
<div class="row">
   
    <div class="col-md-6 p-2">
        &nbsp;
    </div>
</div>
    <button  type="submit" name="add_servicios"  class="btn btn-dark btn-lg m-3 rojo_obscuro_btn" value="addclientes" id="addclientes">Enviar Forma</button>
    <!--<button type="submit" name="add_clientes"  class="btn btn-primary  btn-lg btn-block m-3" value="Guardar datos">Enviar Forma</button>-->
   <div style="width: 700px;">&nbsp;</div>

   

        

            




      




    
        
          

         
    </div>
  <!--  </form>     -->   
    </div>

      

    
   <!-- termina seguda columna-->
    </div>
   
 



    </div>
    
</div>
  </div>
</div>       

  <!--<script src="../content/js/jquery-3.3.1.min.js"></script>-->
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
 <!-- <script src="../content/js/bootstrap.min.js"></script>-->
  <script>
    $("#representanteLegal").css("display", "block");
    $("#datosfacturacion").css("display", "none");

       $(".pago1").click(function(evento){
          
          var valor = $(this).val();
        
          if(valor == 'fisica'){
              $("#representanteLegal").css("display", "block");
              $("#datosfacturacion").css("display", "none");
             
          }else{
            $("#representanteLegal").css("display", "none");
              $("#datosfacturacion").css("display", "block");
           
          }
  });

  var regex = /[^+\d]/g;

//JQuery nuemro de telefono
$("#correofac").keyup(function(){
   if($("#correofac").val() == ""){
      // $("#correofac").val("+")
   }
   $("#correofac").val($("#correofac").val().replace(regex, ""))
});

$("#telcli").keyup(function(){
   if($("#telcli").val() == ""){
      // $("#correofac").val("+")
   }
   $("#telcli").val($("#telcli").val().replace(regex, ""))
});

$("#celular").keyup(function(){
   if($("#celular").val() == ""){
      // $("#correofac").val("+")
   }
   $("#celular").val($("#celular").val().replace(regex, ""))
});
$("#txtCp").keyup(function(){
   if($("#txtCp").val() == ""){
      // $("#correofac").val("+")
   }
   $("#txtCp").val($("#txtCp").val().replace(regex, ""))
});



//mayuscualas
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}

    </script>

<script src="../content/js/funciones.js"></script>
  
  <script src="../content/js/bootstrap.min.js"></script>
</body></html>

