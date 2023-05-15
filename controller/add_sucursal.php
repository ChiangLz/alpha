<?php
include ("../model/model_sucursal.php");
if(isset($_POST['edit_sucursal'])){
    $id=$_POST['id'];
    $nom=$_POST['nom'];
    $dir=$_POST['dir'];
    $tel=$_POST['tel'];
    $cp=$_POST['cp'];
    $estado=$_POST['estado'];
   
    $add_unid=new consul();
    $add=$add_unid->edit_sucursal($id,$nom,$dir,$tel,$cp,$estado);
}


?>