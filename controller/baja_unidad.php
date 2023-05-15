<?php
   include ("../model/bajaUnidad.php");
   include ("../model/liga_BD.php");
   if(isset($_POST['baja_dispo'])){ 
    $valorsuc=$_POST['iduni'];
    $valordescrip=$_POST['descrip'];
    $valormoney=$_POST['precio'];

    $dia = date("y-m-d");

    $sql='SELECT * FROM unidades WHERE noserie='.$valorsuc;
        $result=mysqli_query($link,$sql);
       
        while ($row = mysqli_fetch_assoc($result)) {
            $nomuni=$row['nomuni'];
            $serie=$row['serie'];
            $fecha_alta=$row['fecha_alta'];
            $marca=$row['marca'];
            $modelo=$row['modelo'];
            $placas=$row['placas'];
            $caja=$row['caja'];
            $refrigeracion=$row['refrigeracion'];
            $capacidadmac=$row['capasidad_max'];
            $costo=$row['costo_adquisicion'];
            $descripcion=$row['descripuni'];
            $foto=$row['foto'];
            $tipo=$row['tipo'];
            $idsuc=$row['idsuc'];
           
        }

        $disposicion=5;
        $ultimaactividad="000-00-00";

        $baja=new consul();
  $eliminar=$baja->baja_unidades($valorsuc,$valordescrip,$valormoney,$dia, $idsuc);

        $edit_unid=new consul();
  $edit=$edit_unid->edit_unidades($valorsuc,$nomuni,$serie,$fecha_alta,$marca,$modelo,$placas,$caja,$refrigeracion,$capacidadmac,$costo,
$descripcion,$foto,$tipo,$idsuc,$disposicion,$ultimaactividad);
    }
       
  ?>