<?php
   include ("../model/model_servicios.php");
   include ("../model/liga_BD.php");
   if(isset($_POST['edit_dispo'])){ 
      $valorsuc=$_POST['iduni'];
      $valorfechaActi=$_POST['fechaActivi']; //Corregir el warning
   
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
        $sql="DELETE FROM calendario WHERE fechafin='$valorfechaActi' AND iduni=".$valorsuc;
        $result=mysqli_query($link,$sql);

        $disposicion=1;
        $ultimaactividad="000-00-00";

        $edit_unid=new consul();
  $edit=$edit_unid->edit_unidades1($valorsuc,$nomuni,$serie,$fecha_alta,$marca,$modelo,$placas,$caja,$refrigeracion,$capacidadmac,$costo,
$descripcion,$foto,$tipo,$idsuc,$disposicion,$ultimaactividad);
   }
  ?>