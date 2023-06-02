<?php
include("../model/sesiones.php");
require_once("../model/add_users_model.php");

if(isset($_POST["type"]) && $_POST["type"]=='add_user'){
    if($_POST["name"]!="" && $_POST["email"]!="" && $_POST["account"]!="" && $_POST["password1"]!=""){
        $nomcol = $_POST["name"];
        date_default_timezone_set('America/Mexico_City');
        $fechacol = date("d-m-Y");
        $correo = $_POST["email"];
        $cuenta = $_POST["account"];
        $contra = $_POST["password1"];
        $idrol = $_POST["idrol"];
        $idsuc = $_POST["idsucursal"];

        $consul= new consul();
        $result = $consul->add_colaborador($nomcol,$fechacol,$correo,$cuenta,$contra,$idrol,$idsuc);
        
        echo $result;
    }
    else{
        echo "Por favor, rellene todos los campos";
    }
}
else{
    echo "error";
}

?>