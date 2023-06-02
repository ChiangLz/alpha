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
          <h4 class="text-center m-2">Crear nuevo usuario</h4>
          <p class="text-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor"
              class="bi bi-person-fill-add" viewBox="0 0 16 16">
              <path
                d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              <path
                d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z" />
            </svg>
          </p>
        </div>
          <div class="form-row  mt-2">
            <label for="name">Nombre completo:</label>
            <input type="text" class="form-control mb-3  text-white bg-dark" id="name" placeholder="Nombre"
              name="name" required="true">
          </div>
          <div class="form-row mt-2">
            <label for="email">Correo eléctronico:</label>
            <input type="email" class="form-control mb-3 text-white bg-dark" id="email"
              placeholder="Correo eléctronico" name="email" required="true">
          </div>
          <div class="form-row mt-2">
            <label for="account">Nombre de la cuenta:</label>
            <input type="text" class="form-control mb-3 text-white bg-dark" id="account"
              placeholder="Nombre de la cuenta" name="account" required="true">
          </div>
          <div class="form-row mt-2">
            <div class="col">
              <label for="password1">Contraseña:</label>
              <input type="password" class="form-control mb-3 text-white bg-dark" id="password1"
                placeholder="Contraseña" name="password1" required="true">
            </div>
            <div class="col">
              <label for="password2">Repite la contraseña:</label>
              <input type="password" class="form-control mb-3 text-white bg-dark" id="password2"
                placeholder="Repite la contraseña" name="password2" required="true">
            </div>
          </div>
          <div class="form-row mt-2">
            <div class="col">
              <label for="rol">Selecciona un rol:</label>
              <select id="rol" class="form-control mb-3 text-white bg-dark">
                <?php foreach ($roles as $row) { ?>
                  <option value='<?php echo $row['id']; ?>'><?php echo $row['tipo_rol']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col">
              <label for="branchOffice">Selecciona una sucursal:</label>
              <select id="branchOffice" class="form-control mb-3 text-white bg-dark">
                <?php foreach ($branchOffice as $row) { ?>
                  <option value='<?php echo $row['id']; ?>'><?php echo $row['nomsuc']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <p class="text-center">
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
    var password1 =$('#password1').val();
    var password2 =$('#password2').val();

    if(password1==password2){
      var name =$('#name').val();
      var email =$('#email').val();
      var account =$('#account').val();
      var idrol =$('#rol option:selected').val();
      var idsucursal =$('#branchOffice option:selected').val();
      
      $.ajax({
        type:"POST",
        url:"../controller/add_users_controller.php",
        data: "type=add_user"+"&name=" + name + "&email=" + email + 
        "&account="+ account +"&idrol=" + idrol +"&idsucursal=" + idsucursal+
        "&password1=" + password1,
        success:function(response){
          if(response=='error'){
            alert("Lo sentimos, ocurrio un error. ¡Intentalo más tarde!");
          }
          else if(response=='correo'){
            alert("El correo ya existe, por favor cambielo");
          }
          else{
            alert(response);
            $('#password1').val('');
            $('#password2').val('');
            $('#name').val('');
            $('#email').val('');
            $('#account').val('');
          }
      }});
      
    }
    else{
      alert("Las contraseñas no coinciden. ¡Inténtalo de nuevo!");
    }
  });

  
  $('#back').click(function(){
    location.href ='menus_cuadros.php';
  });
</script>