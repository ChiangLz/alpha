<?php
include ("../model/unidades.php");
if(isset($_POST['add_unidad'])){
    $nombre=$_POST['nombre'];
    $fecha=$_POST['fecha'];
      $marca=$_POST['marca'];
     $modelo=$_POST['modelo'];
      $numserie=$_POST['numserie'];
      $placas=$_POST['placas'];
      $caja=$_POST['caja'];

      $refrigeracion=$_POST['refrigeracion'];
      $capasidad=$_POST['capasidad'];
      $costo=$_POST['costo'];
  
     $comentario=$_POST['comentario'];
      $idsucursal=$_POST['idsucursal'];

    $foto=$_FILES[ 'foto1' ][ 'tmp_name' ];
    //echo $foto;
    $ruta_img="../content/unidad/IMG_$numserie.jpg";
    $name_img="IMG_$numserie.jpg";
    $ruta="../content/unidad/";
    move_uploaded_file($foto, "$ruta$name_img");

    $actividad="0000-00-00";

    if($caja=="si"){
      $tipo="camion";
    }else{
      $tipo="nissan";
    }

    $add_unid=new consul();
    $add=$add_unid->add_unidades($nombre,$fecha,$marca,$modelo,$numserie,$placas,$caja,$refrigeracion,$capasidad,$costo,$comentario,$idsucursal,$ruta_img,$actividad,$tipo);
}

if(isset($_POST['edit_unidad'])){

 //echo "entre edite uni ";
  $nombre=$_POST['nombre'];
  $fecha=$_POST['fecha'];
    $marca=$_POST['marca'];
   $modelo=$_POST['modelo'];
    $numserie=$_POST['numserie'];
    $placas=$_POST['placas'];
    $caja=$_POST['caja'];
    $refrigeracion=$_POST['refrigeracion'];
    $capasidad=$_POST['capasidad'];
    $costo=$_POST['costo'];

   $comentario=$_POST['comentario'];
    $idsucursal=$_POST['ids'];
    $idunidad=$_POST['iduni'];
    $disponiilidad=$_POST['iddis'];
   // $tipo=$_POST['tip'];
    $activi=$_POST['acti'];

    if($caja=="si"){
      $tipo="camion";
    }else{
      $tipo="nissan";
    }
   

  $foto=$_FILES[ 'foto' ][ 'tmp_name' ];

  $ruta_img="../content/unidad/IMGEDIT_$numserie.jpg";
  $name_img="IMGEDIT_$numserie.jpg";
  $ruta="../content/unidad/";
  move_uploaded_file($foto, "$ruta$name_img");
  $edit_unid=new consul();
  $edit=$edit_unid->edit_unidades($nombre,$fecha,$marca,$modelo,$numserie,$placas,$caja,$refrigeracion,$capasidad,$costo,$comentario,$idsucursal,$ruta_img,$idunidad,$disponiilidad,$tipo,$activi);
 
}




?>