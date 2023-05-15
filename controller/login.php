<?php ob_start();?>
<?php
session_start();
?>
    

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<?php
    $us=$_POST["usuario"];
    $cont=$_POST["contrasena"];

    $_SESSION['user']=$us;
    $_SESSION['pw']=$cont;

 echo '<a href="../views/menus_cuadros.php"></a>';

include ("../model/acciones.php");
    $rob=new consul();
    $iniciar=$rob->login($us,$cont);
    
foreach ($iniciar as $row){
    $rol = $row['tipo_rol'];
    $_SESSION['idc']=$row['idc'];
    $_SESSION['ids']=$row['ids'];
    $_SESSION['idr'] = $row['idr'];
    $_SESSION['colaborador'] = $row['nomcol'];
    $_SESSION['rol'] = $row['tipo_rol'];
}



if(sizeof($iniciar)>0){
    $_SESSION['login'] = true;
    $_SESSION['usuario'] = $us;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (600);//tiempo de 600segundos por sesion

    if($rol == "SuperAdministrador"){
        $_SESSION['rol'] = $rol;
        header("location: ../views/menus_cuadros.php");
    }
    else if($rol == "Administrador"){
        $_SESSION['rol'] = $rol;
        header("location: ../views/menus_cuadros.php");
    }
    else if($rol == "Colaboradores"){
        $_SESSION['rol'] = $rol;
        header("location: ../views/menus_cuadros.php");
    }
    else{
        echo'<script type="text/javascript">
        alert("Rol no existe, dar de alta");
        window.location.href="../";
        </script>'    ;
    }
}
else{
    echo'<script type="text/javascript">
    alert("Usuario y/o contraseña incorrectos");
    window.location.href="../";
    </script>';
}


?>
<?php ob_end_flush();?>