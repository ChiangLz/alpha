<?php
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente

require_once("../model/clientes.php");

$idc = $_GET['idcli'];
$col= new consul();
$detallecliente = $col->clientes($idc);
$col2= new consul();
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
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <link rel="stylesheet" href="../content/js/popper.min.js">
    
  </head>
 
  <body>
  


  <!-- Content here -->          
<div class="container border border-secondary">
  <div class="row bg-dark">
              <div class="col-md-4 d-none d-md-block"><img src="../content/imagenes/logo.png" alt="IRIS" class="logo_iris"></div>
              <div class="col-sm-6 col-md-4 text-center user_text"><?php foreach ($detalleCol as $row2) { ?>
               <span class="gris_claro">Bienvenido:</span> <?php echo $row2['cuenta']; }?> </div>  
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
       
        
    </div>
  </div>      
      <!--Segunda columna-->
      <div class=""> 
        <div class="contenedor_cabezal  border_seccion bg-white mb-2">          
          <h1 class="text-center rojo_obscuro titulo_seccion mt-3 mb-2">Clientes Editar Usuario</h1>    
      </div>
     

  

     <div class="d-flex justify-content-center p-3">
            <div class="border rounded p-3 text-center box_sucursal m-3">
              <i class="fas fa-user-cog fa-4x m-3 rojo_obscuro"></i>
              <p class=" h5"> Editar Usuario:</p>
              <form class="text-dark p-3 needs-validation"  novalidate action="../controller/add_cliente.php" method="post" enctype="multipart/form-data">
        <div class="row">

          <div  class="col-md-12 " id="grupo__nombre">
          <?php foreach ($detallecliente as $row) { ?>
            
            <p class="h4">Cliente persona física:</p>
             <div class="row ">
             <input hidden type="text"  name="idcli" id="name" class="form-control " value="<?php echo $row['id']; ?>" placeholder="Nombre" required>
             <input hidden type="text"  name="idsuccli" class="form-control " value="<?php echo $row['idsucur']; ?>" placeholder="Nombre" required>
              <div class="col-md-6 p-2">
                <label for="name"> Nombre del contacto *</label>
                <input type="text"   name="contacto" id="contacto"class="form-control " value="<?php echo $row['contacto']; ?>" placeholder="Nombre" required>
                 <div class="valid-feedback">
                        Correcto
                        </div>
                         <div class="invalid-feedback">
                        Por favor introduzca un nombre válido
                      </div>
                </div>
              <div class="col-md-6 p-2">
                <label for="email_contacto"> Email  *</label>
                <input type="email" name="correocont" id="correocont" class="form-control" value="<?php echo $row['correocont']; ?>" placeholder="telefono" name="email_contacto" required>
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
                            <input type="text"  name="nomcli" id="nomcli" class="form-control " value="<?php echo $row['nomcli']; ?>" placeholder="Nombre" required>
                            <div class="valid-feedback">
                                    Correcto
                                    </div>
                                    <div class="invalid-feedback">
                                    Por favor introduzca un nombre válido
                                  </div>
                            </div>
                          <div class="col-md-6 p-2">
                            <label for="telefono"> Telefono *</label>
                            <input type="text" name="telcli" id="telcli" class="form-control" value="<?php echo $row['telcli']; ?>" placeholder="telefono" name="puesto" required>
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
                              <input type="text"  name="celular" class="form-control" value="<?php echo $row['celular']; ?>" placeholder="Telefono" required>
                              <div class="valid-feedback">
                                      Correcto
                                      </div>
                                      <div class="invalid-feedback">
                                      Por favor introduzca un telefono válido
                                    </div>
                            </div>             
                            <div class="col-md-6 p-2">
                              <label for="INE"> No. IFE (ahora INE) </label>
                              <input type="text" name="ine" value="<?php echo $row['ine']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 p-2">
                              <label for="email"> Email *</label>
                              <input type="text"  name="correocli" class="form-control" value="<?php echo $row['correocli']; ?>" placeholder="Email" required>
                              <div class="valid-feedback">
                                      Correcto
                                      </div>
                                      <div class="invalid-feedback">
                                      Por favor introduzca un correo válido
                                    </div>
                            </div>               
                            <div class="col m-2">
                              <label for="Orden de compra"> Dirección </label>
                              <input type="text"  name="dircli" class="form-control" value="<?php echo $row['dircli']; ?>" placeholder="Direcion">
                            </div>
                        </div>
                      </div>
                  </div>         
               </div>
       <!-- empieza forma facturacion--->  
       <div id="datosfacturacion" >  
          <p class="h3  mt-3">Datos de Facturación</p>
          <div class="row">
            <div class="col-md-6 p-2">
                <label for="RazonSocial *">Razón Social *</label>
                <input type="text" name="razonsocial" class="form-control" value="<?php echo $row['razonsocial']; ?>" placeholder="Ej.:Coca Cola" required />
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Por favor introduzca la Razón Social</div>
            </div>
            <div class="col-md-6 p-2">
                <label for="RazonSocial *">Dirección Fiscal *</label>
                <input type="text" name="dirsocial" id="txtDireccionfiscal" class="form-control" value="<?php echo $row['dirsocial']; ?>" placeholder="Ej.:  Av. España #123" required />
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Por favor introduzca Dirección de Facturación</div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 p-2">
                <label for="txtColonia *">Colonia * </label>
                <input type="text" name="colonia" id="txtColonia" class="form-control" required  value="<?php echo $row['colonia']; ?>" placeholder="Ej.: Fracc. Reforma" />
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Por favor introduzca la colonia</div>
            </div>
            <div class="col-md-6 p-2">
                <label for="txtCiudad *">Ciudad *</label>
                <input type="text" name="ciudad" id="txtCiudad" class="form-control"  required value="<?php echo $row['ciudad']; ?>" placeholder="Ej.: Veracruz" />
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Por favor introduzca la Ciudad</div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 p-2">
                <label for="txtEstado *">Estado * </label>
                <input type="text" name="estado" id="txtEstado" class="form-control"  required value="<?php echo $row['estado']; ?>" placeholder="Ej.: Veracruz" />
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Por favor introduzca el estado</div>
            </div>
            <div class="col-md-6 p-2">
                <label for="txtCp *">Código Postal *</label>
                <input type="text" name="cp" id="txtCp" class="form-control"  required value="<?php echo $row['cp']; ?>" placeholder="Ej.: 91919" />
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Por favor introduzca el Código Postal</div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 p-2">
                <label for="txtRfc *">RFC * </label>
                <input type="text" name="rfc" id="txtRfc" class="form-control"  required value="<?php echo $row['rfc']; ?>" placeholder="Ej.: MUJI701020ABC" />
                <div class="valid-feedback">Correcto</div>
                <div class="invalid-feedback">Por favor introduzca el RFC</div>
            </div>
            <div class="col-md-6 p-2">
              <label for="email2"> Email *</label>
              <input type="text"  name="correofac" class="form-control" value="<?php echo $row['correofac']; ?>" placeholder="Email" required>
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
          <?php }?>
    <button type="submit" name="edit_cliente" class="btn btn-primary  btn-lg btn-block m-3" value="Guardar datos">Enviar Forma</button>

   <div style="width: 700px;">&nbsp;</div>
    </div>
               
    </div>

    </form>

    
   <!-- termina seguda columna-->
    </div>
   
 



    </div>
    
</div>
  </div>
</div>       

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
      const button = document.querySelector('#button');
      const tooltip = document.querySelector('#tooltip');

      Popper.createPopper(button, tooltip);
    </script>
</body></html>

<script>
   $("#representanteLegal").css("display", "block");
    $("#datosfacturacion").css("display", "none");

            alert("Hola1");
       $(".pago1").click(function(evento){
          alert($(this).val());
          var valor = $(this).val();
        
          if(valor == 'fisica'){
              $("#representanteLegal").css("display", "block");
              $("#datosfacturacion").css("display", "none");
             
          }else{
            $("#representanteLegal").css("display", "none");
              $("#datosfacturacion").css("display", "block");
           
          }
  });

 $(function() {
  
  // obtener campos ocultar div
  var checkbox = $(".checkshow");
  var hidden = $(".div_a_mostrar");
  //var populate = $("#populate");
    
  hidden.hide();
     checkbox.change(function() {
         if (checkbox.is(':checked')) {
        //hidden.show();
            $(".div_a_mostrar").fadeIn("200")
          } else {
             //hidden.hide();
    $(".div_a_mostrar").fadeOut("200")
             $("#val1 , #val2, #val3").val(""); // limpia los valores de lols input al ser ocultado
             $('input[type=checkbox]').prop('checked',false);// limpia los valores de checkbox al ser ocultado
             
    }
  });
});

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>