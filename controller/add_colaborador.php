<?php
include ("../model/model_sucursal.php");
if(isset($_POST['edit_col'])){
     $rol=$_POST['rolid'];
    
    $idsuc=$_POST['idsuc'];
    $idcola=$_POST['idcola'];
    $nomcola=$_POST['nomcola'];
    $fecha=$_POST['fecha'];
    $correo=$_POST['correo'];
    $cuenta=$_POST['cuenta'];
    $contracola=$_POST['contracola'];

    if($_POST['rolid']==2){
        $id_rol=$_POST['rolid2'];
        
    }
    if($_POST['rolid']==1){
        $id_rol=$_POST['id_rol'];
    }
    
    //echo $id_rol;
    
   
   
    $add_unid=new consul();
    $add=$add_unid->edit_colaborador($idsuc,$idcola,$nomcola,$fecha,$correo,$cuenta,$contracola,$id_rol);
}


?>