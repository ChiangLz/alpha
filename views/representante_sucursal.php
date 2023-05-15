<?php 
include("../model/sesiones.php");//valida sesiona activa esta linea va en cada php que muestre info o que interacciones con el cliente
require_once("../model/representante.php");
$idr=$_GET['idr'];
$ids=$_GET['ids'];
$col= new consul();
$detallerepresentantesuc= $col->representantesuc($idr);
$col1= new consul();
$detallecol= $col1->colaboradores($_SESSION['idc']);
$col2= new consul();
$detallesuc= $col2->sucursal($ids);
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
              <?php foreach ($detallecol as $row) { ?>
               <span class="gris_claro">Bienvenido:</span> <?php echo $row['cuenta']; }?></div>  
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
        <!--  <a href="clientes.php"><i class="fas fa-suitcase m-3 " data-toggle="tooltip" data-placement="right" title="Clientes">-->
        </i>
        </a>
        <!--<a href="add_cliente.php"><i class="far fa-plus-square m-3 " data-toggle="tooltip" data-placement="right" title="Clientes">-->
        </i>
        </a>
        
    </div>
  </div>      
      <!--Segunda columna-->
      <div class=""> 
        <div class="contenedor_cabezal  border_seccion bg-white mb-2"> 
        <div class="float-right m-3">
        <?php foreach ($detallesuc as $rowss) { ?>
          <a href="sucursales_edicion_suc.php?id=<?php echo $rowss['id']; ?>"><i class="fas fa-chevron-left rojo_obscuro fa-2x"></i></a>
          <?php }?>
        </div>         
          <h1 class="text-center rojo_obscuro titulo_seccion mt-3 mb-2">Editar Representante Legal</h1>   
          
      </div>
     

  

     <div class="d-flex justify-content-center p-3">
            <div class="border rounded p-3 text-center box_sucursal m-3">
              <i class="fas fa-user-cog fa-4x m-3 rojo_obscuro"></i>
              <p class=" h5"> Editar Representante:</p>
   <form  action="../controller/add_representante.php" class="text-dark p-3 needs-validation"  novalidate method="post" enctype="multipart/form-data">      
   
   <?php foreach ($detallerepresentantesuc as $rowr) { ?>
         <input hidden type="text" id="idsucrep" name="idsucrep" value="<?php echo $rowr['idsuc']; ?>">
         <input hidden type="text" id="idrepre" name="idrepre" value="<?php echo $rowr['id']; ?>">

        <div class="row">

          <div  class="col-md-12 " id="grupo__nombre">
            
            <p class="h4">Persona Física:</p>
             <div class="row ">
              <div class="col-md-6 p-2">
                <label for="name"> Nombre del contacto *</label>
                <input type="text"  name="contacto" id="contacto" class="form-control " placeholder="Nombre" value="<?php echo $rowr['nomrepre']; ?>" required>
                 <div class="valid-feedback">
                        Correcto
                        </div>
                         <div class="invalid-feedback">
                        Por favor introduzca un nombre válido
                      </div>
                </div>
              <div class="col-md-6 p-2">
                <label for="email_contacto"> Email  *</label>
                <input type="email" class="form-control" placeholder="correo" name="correocont" id="correocont" value="<?php echo $rowr['correorepre']; ?>" required>
                 <div class="valid-feedback">
                        Correcto
                        </div>
                         <div class="invalid-feedback">
                        Por favor introduzca un correo válido
                      </div>
              </div>              
            </div>
            <hr>
            <div class="row">
              <div class="col">
                 <p class="h3  mt-3">Representante Legal</p>
              </div>
            </div>

            <div class="row ">
              <div class="col-md-6 p-2">
                <label for="name"> Nombre *</label>
                <input type="text"  name="nomcli" id="nomcli" class="form-control " placeholder="Nombre" value="<?php echo $rowr['contactorepre']; ?>" required>
                 <div class="valid-feedback">
                        Correcto
                        </div>
                         <div class="invalid-feedback">
                        Por favor introduzca un nombre válido
                      </div>
                </div>
              <div class="col-md-6 p-2">
                <label for="telefono"> Telefono *</label>
                <input type="text" class="form-control" placeholder="telefono" name="telcli" id="telcli" value="<?php echo $rowr['telrepre']; ?>" required>
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
                <input type="text" id="celular"  name="celular"class="form-control" placeholder="Telefono" value="<?php echo $rowr['celularrepre']; ?>" required>
                <div class="valid-feedback">
                        Correcto
                        </div>
                         <div class="invalid-feedback">
                        Por favor introduzca un telefono válido
                      </div>
              </div>             
              <div class="col-md-6 p-2">
                <label for="INE"> No. IFE (ahora INE) </label>
                <input type="text" name="ine"class="form-control"  value="<?php echo $rowr['ine']; ?>">
              </div>
           </div>
           <div class="row">
              <div class="col-md-6 p-2">
                <label for="email"> Email *</label>
                <input type="text"  name="correocli" class="form-control" placeholder="Email" value="<?php echo $rowr['corepre']; ?>" required>
                <div class="valid-feedback">
                        Correcto
                        </div>
                         <div class="invalid-feedback">
                        Por favor introduzca un correo válido
                      </div>
              </div>               
              <div class="col m-2">
                <label for="Orden de compra"> Dirección </label>
                <input type="text"  name="dircli"class="form-control" placeholder="Direcion" value="<?php echo $rowr['dirrepre']; ?>" >
              </div>
           </div>
        </div>         
      </div>
       <!-- empieza forma facturacion--->    
   

          <div class="row">
    <div class="col-md-6 p-2">
        <label for="RazonSocial *">Razón Social *</label>
        <input type="text" name="razonsocial" class="form-control" placeholder="Ej.:Coca Cola" value="<?php echo $rowr['razonsocialrepre']; ?>" required />
         <div class="valid-feedback">Correcto</div>
        <div class="invalid-feedback">Por favor introduzca la Razón Social</div>
    </div>
    <div class="col-md-6 p-2">
        <label for="RazonSocial *">Dirección Fiscal *</label>
        <input type="text" name="dirsocial" id="Direccionfiscal" class="form-control" placeholder="Ej.:  Av. España #123" value="<?php echo $rowr['dirsocialrepre']; ?>" required />
        <div class="valid-feedback">Correcto</div>
        <div class="invalid-feedback">Por favor introduzca Dirección de Facturación</div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 p-2">
        <label for="txtColonia *">Colonia * </label>
        <input type="text" name="colonia" id="txtColonia" class="form-control" value="<?php echo $rowr['coloniarepre']; ?>" required  placeholder="Ej.: Fracc. Reforma" />
        <div class="valid-feedback">Correcto</div>
        <div class="invalid-feedback">Por favor introduzca la colonia</div>
    </div>
    <div class="col-md-6 p-2">
        <label for="txtCiudad *">Ciudad *</label>
        <input type="text" name="ciudad" id="txtCiudad" class="form-control"  value="<?php echo $rowr['ciudadrepre']; ?>" required placeholder="Ej.: Veracruz" />
        <div class="valid-feedback">Correcto</div>
        <div class="invalid-feedback">Por favor introduzca la Ciudad</div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 p-2">
        <label for="txtEstado *">Estado * </label>
        <input type="text" name="estado" id="txtEstado" class="form-control"  value="<?php echo $rowr['estadorepre']; ?>" required placeholder="Ej.: Veracruz" />
        <div class="valid-feedback">Correcto</div>
        <div class="invalid-feedback">Por favor introduzca el estado</div>
    </div>
    <div class="col-md-6 p-2">
        <label for="txtCp *">Código Postal *</label>
        <input type="text" name="cp" id="txtCp" class="form-control"  value="<?php echo $rowr['cp']; ?>" required placeholder="Ej.: 91919" />
        <div class="valid-feedback">Correcto</div>
        <div class="invalid-feedback">Por favor introduzca el Código Postal</div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 p-2">
        <label for="txtRfc *">RFC * </label>
        <input type="text" name="rfc" id="txtRfc" class="form-control"  value="<?php echo $rowr['rfcrepre']; ?>" required placeholder="Ej.: MUJI701020ABC" />
        <div class="valid-feedback">Correcto</div>
        <div class="invalid-feedback">Por favor introduzca el RFC</div>
    </div>
    <div class="col-md-6 p-2">
                <label for="email2"> Email *</label>
                <input type="text"  name="correofac" class="form-control" placeholder="Email" value="<?php echo $rowr['correreprefac']; ?>" required>
                <div class="valid-feedback">
                        Correcto
                        </div>
                         <div class="invalid-feedback">
                        Por favor introduzca un correo válido
                      </div>
              </div>      
    
</div>

<div class="row">
   
    <div class="col-md-6 p-2">
        &nbsp;
    </div>
</div>
    <button type="submit" name="add_representante"  class="btn btn-primary  btn-lg btn-block m-3" value="Guardar datos">Enviar Forma</button>

   <div style="width: 700px;">&nbsp;</div>

           
    </div>
    <?php }?>
    </form>        
    </div>

      

    
   <!-- termina seguda columna-->
    </div>
   
 



    </div>
    
</div>
  </div>
</div>       

  <script src="../content/js/jquery-3.3.1.min.js"></script>
  <script src="../content/js/bootstrap.min.js"></script>
 
</body></html>

<script>
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