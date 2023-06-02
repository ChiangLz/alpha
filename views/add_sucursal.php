<?php
include("../model/sesiones.php");
require_once("../model/add_users_model.php");
$consul= new consul();
$roles = $consul->getRoles();
$consul= new consul();
$branchOffice =  $consul->getBranchOffice();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="../views/icon_logo.gif">
  <title>Alfa Logistics MX
  </title>

  <!-- Bootstrap core CSS -->
  <link async href="../content/css/bootstrap.css" rel="stylesheet">

  <link async rel="stylesheet" href="../content/css/estilos.css">
  <!-- Custom Fonts -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

</head>

<body class="degradado">
  <div class="container-fluid " style="max-height: 600px;">
    <div class="row">

      <div class="cuadro_forma bg-white border rounded w-50">
        <div class=" mb-3">
            <img src="../content/imagenes/logo_inicio.jpg" alt="ALFA" width="70">
            <h4 class="text-center m-2">Crear nueva sucursal</h4>
            <p class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-building-fill-add" viewBox="0 0 16 16">
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Z"/>
                    <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v7.256A4.493 4.493 0 0 0 12.5 8a4.493 4.493 0 0 0-3.59 1.787A.498.498 0 0 0 9 9.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .39-.187A4.476 4.476 0 0 0 8.027 12H6.5a.5.5 0 0 0-.5.5V16H3a1 1 0 0 1-1-1V1Zm2 1.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5Zm3 0v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1ZM4 5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5ZM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5ZM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z"/>
                </svg>
            </p>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Datos de la sucursal</h5>
                <p class="card-text">
                    <div class="form-row  mt-2">
                        <div class="col">
                            <label for="name_suc">Nombre:</label>
                            <input type="text" class="form-control mb-3 text-white bg-dark" id="name_suc"
                                placeholder="Nombre" name="name_suc" required="true">
                            </div>
                            <div class="col">
                            <label for="phone_suc">Teléfono:</label>
                            <input type="phone" class="form-control mb-3 text-white bg-dark" id="phone_suc"
                                placeholder="Teléfono" name="phone_suc" required="true">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                        <label for="cp_suc">Código postal:</label>
                        <input type="text" class="form-control mb-3 text-white bg-dark" id="cp_suc"
                            placeholder="Código postal" name="cp_suc" required="true">
                        </div>
                        <div class="col">
                        <label for="state_suc">Estado:</label>
                        <input type="text" class="form-control mb-3 text-white bg-dark" id="state_suc"
                            placeholder="Estado" name="state_suc" required="true">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <label for="address_suc">Dirección:</label>
                        <input type="text" class="form-control mb-3 text-white bg-dark" id="address_suc"
                        placeholder="Dirección" name="address_suc" required="true">
                    </div>
                </p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Datos del representante</h5>
                <p class="card-text">
                    <div class="form-row  mt-2">
                        <div class="col">
                            <label for="name_rep">Nombre:</label>
                            <input type="text" class="form-control mb-3 text-white bg-dark" id="name_rep"
                                placeholder="Nombre" name="name_rep" required="true">
                            </div>
                            <div class="col">
                            <label for="email_rep">Correo eléctronico:</label>
                            <input type="text" class="form-control mb-3 text-white bg-dark" id="email_rep"
                                placeholder="Correo eléctronico" name="email_rep" required="true">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                        <label for="contact_rep">Contacto:</label>
                        <input type="text" class="form-control mb-3 text-white bg-dark" id="contact_rep"
                            placeholder="Contacto" name="contact_rep" required="true">
                        </div>
                        <div class="col">
                        <label for="phone_rep">Teléfono:</label>
                        <input type="phone" class="form-control mb-3 text-white bg-dark" id="phone_rep"
                            placeholder="Teléfono" name="phone_rep" required="true">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                        <label for="cel_rep">Celular:</label>
                        <input type="text" class="form-control mb-3 text-white bg-dark" id="cel_rep"
                        placeholder="Celular" name="cel_rep" required="true">
                        </div>
                        <div class="col">
                        <label for="ine_rep">INE:</label>
                        <input type="text" class="form-control mb-3 text-white bg-dark" id="ine_rep"
                        placeholder="INE" name="ine_rep" required="true">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                        <label for="address_rep">Direción:</label>
                        <input type="text" class="form-control mb-3 text-white bg-dark" id="address_rep"
                        placeholder="Direción" name="address_rep" required="true">
                        </div>
                        <div class="col">
                        <label for="reason_social_rep">Razón social:</label>
                        <input type="text" class="form-control mb-3 text-white bg-dark" id="reason_social_rep"
                        placeholder="Razón social" name="reason_social_rep" required="true">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                        <label for="address_social_rep">Direción social:</label>
                        <input type="text" class="form-control mb-3 text-white bg-dark" id="address_social_rep"
                        placeholder="Direción social" name="address_social_rep" required="true">
                        </div>
                        <div class="col">
                        <label for="suburb_rep">Colonia:</label>
                        <input type="text" class="form-control mb-3 text-white bg-dark" id="suburb_rep"
                        placeholder="Colonia" name="suburb_rep" required="true">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                        <label for="country_rep">Ciudad:</label>
                        <input type="text" class="form-control mb-3 text-white bg-dark" id="country_rep"
                        placeholder="Ciudad" name="country_rep" required="true">
                        </div>
                        <div class="col">
                        <label for="state_rep">Estado:</label>
                        <input type="text" class="form-control mb-3 text-white bg-dark" id="state_rep"
                        placeholder="Estado" name="state_rep" required="true">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                        <label for="email_contact_rep">Correo del contacto:</label>
                        <input type="text" class="form-control mb-3 text-white bg-dark" id="email_contact_rep"
                        placeholder="Correo" name="email_contact_rep" required="true">
                        </div>
                        <div class="col">
                        <label for="cp_rep">Código postal:</label>
                        <input type="text" class="form-control mb-3 text-white bg-dark" id="cp_rep"
                        placeholder="Código postal" name="cp_rep" required="true">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                        <label for="rfc_rep">RFC:</label>
                        <input type="text" class="form-control mb-3 text-white bg-dark" id="rfc_rep"
                        placeholder="Correo" name="email_moral_rfc_reprep" required="true">
                        </div>
                        <div class="col">
                        <label for="email_fac_rep">Correo de facturación:</label>
                        <input type="text" class="form-control mb-3 text-white bg-dark" id="email_fac_rep"
                        placeholder="Correo de facturación" name="email_fac_rep" required="true">
                        </div>
                    </div>
                </p>
            </div>
        </div>
          <p class="text-center mt-4">
            <button class="btn btn-success btn-lg" id="register">Registrar</button>
            <button class="btn btn-danger btn-lg ml-5" id="back">Regresar</button>
          </p>
      </div>
    </div>
  </div>
</body>

</html>
<script src="../content/js/jquery-3.3.1.min.js"></script>
<script src="../content/js/bootstrap.min.js"></script>
<script>
  $('#register').click(function(){
    //Sucursal
    var name_suc =$('#name_suc').val();
    var phone_suc =$('#phone_suc').val();
    var cp_suc =$('#cp_suc').val();
    var state_suc =$('#state_suc').val();
    var address_suc =$('#address_suc').val();

    //Representante
    var name_rep =$('#name_rep').val();
    var email_rep =$('#email_rep').val();
    var contact_rep =$('#contact_rep').val();
    var phone_rep =$('#phone_rep').val();
    var cel_rep =$('#cel_rep').val();

    var ine_rep =$('#ine_rep').val();
    var address_rep =$('#address_rep').val();
    var reason_social_rep =$('#reason_social_rep').val();
    var address_social_rep =$('#address_social_rep').val();
    var suburb_rep =$('#suburb_rep').val();

    var country_rep =$('#country_rep').val();
    var state_rep =$('#state_rep').val();
    var email_contact_rep =$('#email_contact_rep').val();
    var cp_rep =$('#cp_rep').val();
    var rfc_rep =$('#rfc_rep').val();
    var email_fac_rep =$('#email_fac_rep').val();

    if(name_suc!="" ||
    phone_suc!="" ||
    cp_suc!="" ||
    state_suc!="" ||
    address_suc!=""){

        if(name_rep!="" ||
        email_rep!="" ||
        contact_rep!="" ||
        phone_rep!="" ||
        cel_rep!="" ||

        ine_rep!="" ||
        address_rep!="" ||
        reason_social_rep!="" ||
        address_social_rep!="" ||
        suburb_rep!="" ||

        country_rep!="" ||
        state_rep!="" ||
        email_contact_rep!="" ||
        cp_rep!="" ||
        rfc_rep!="" ||
        email_fac_rep!=""){
            
            $.ajax({
            type:"POST",
            url:"../controller/add_representante.php",
            data: "type=add_sucursal"+
            "&name_suc=" + name_suc 
            + "&phone_suc=" + phone_suc 
            + "&cp_suc="+ cp_suc 
            +"&state_suc=" + state_suc 
            +"&address_suc=" + address_suc
            
            +"&name_rep=" + name_rep
            +"&email_rep=" + email_rep
            +"&contact_rep=" + contact_rep
            +"&phone_rep=" + phone_rep
            +"&cel_rep=" + cel_rep

            
            +"&ine_rep=" + ine_rep
            +"&address_rep=" + address_rep
            +"&reason_social_rep=" + reason_social_rep
            +"&address_social_rep=" + address_social_rep
            +"&suburb_rep=" + suburb_rep

            
            +"&country_rep=" + country_rep
            +"&state_rep=" + state_rep
            +"&email_contact_rep=" + email_contact_rep
            +"&cp_rep=" + cp_rep
            +"&rfc_rep=" + rfc_rep
            +"&email_fac_rep=" + email_fac_rep,
            success:function(response){
                if(response=='error'){
                alert("Lo sentimos, ocurrio un error. ¡Intentalo más tarde!");
                }
                else{
                alert(response);
                
                //Sucursal
                $('#name_suc').val('');
                $('#phone_suc').val('');
                $('#cp_suc').val('');
                $('#state_suc').val('');
                $('#address_suc').val('');

                //Representante
                $('#name_rep').val('');
                $('#email_rep').val('');
                $('#contact_rep').val('');
                $('#phone_rep').val('');
                $('#cel_rep').val('');

                $('#ine_rep').val('');
                $('#address_rep').val('');
                $('#reason_social_rep').val('');
                $('#address_social_rep').val('');
                $('#suburb_rep').val('');

                $('#country_rep').val('');
                $('#state_rep').val('');
                $('#email_contact_rep').val('');
                $('#cp_rep').val('');
                $('#rfc_rep').val('');
                $('#email_fac_rep').val('');
                }
            }});
        }
        else{
            alert("Por favor, rellene todos los datos del representante");
        }
    }
    else{
        alert("Por favor, rellene todos los datos de la sucursal");
    }
  });

  
  $('#back').click(function(){
    location.href ='sucursales.php';
  });
</script>