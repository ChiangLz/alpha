<?php
include ("../model/liga_BD.php");
if($_POST['consutla']=="cliente"){
  
    
    $sql = "SELECT cliente.id as idc, cliente.nomcli, servicio.tipo, servicio.id as ids, unidades.noserie, unidades.nomuni, unidades.marca, unidades.modelo, unidades.placas, orden_servicio.id as ido, orden_servicio.fecha_inicial, orden_servicio.fecha_final, orden_servicio.hora_inicial, orden_servicio.hora_final, orden_servicio.kilometraje, orden_servicio.marcandia_transportar, orden_servicio.dirrecoleccion, orden_servicio.direntrega, orden_servicio.hrecoleccion, orden_servicio.hrcita, orden_servicio.ciudaddestino FROM orden_servicio INNER JOIN cliente ON cliente.id=orden_servicio.idcli INNER JOIN unidades on unidades.noserie=orden_servicio.iduni INNER JOIN servicio ON servicio.id=orden_servicio.idservi WHERE cliente.id=".$_POST['idc'];
    $result = mysqli_query($link,$sql);
    while($fila = mysqli_fetch_array($result)) {
        $arregloReport[]=$fila;
    }
  }
  if($_POST['consutla']=="unidad"){
  
    
    $sql = "SELECT cliente.id as idc, cliente.nomcli, servicio.tipo, servicio.id as ids, unidades.noserie, unidades.nomuni, unidades.marca, unidades.modelo, unidades.placas, orden_servicio.id as ido, orden_servicio.fecha_inicial, orden_servicio.fecha_final, orden_servicio.hora_inicial, orden_servicio.hora_final, orden_servicio.kilometraje, orden_servicio.marcandia_transportar, orden_servicio.dirrecoleccion, orden_servicio.direntrega, orden_servicio.hrecoleccion, orden_servicio.hrcita, orden_servicio.ciudaddestino FROM orden_servicio INNER JOIN cliente ON cliente.id=orden_servicio.idcli INNER JOIN unidades on unidades.noserie=orden_servicio.iduni INNER JOIN servicio ON servicio.id=orden_servicio.idservi WHERE unidades.noserie=".$_POST['idu'];
    $result = mysqli_query($link,$sql);
    while($fila = mysqli_fetch_array($result)) {
        $arregloReport[]=$fila;
    }
  }
  if($_POST['consutla']=="fechaRango"){
    $ini=$_POST['fini'];
    $fin=$_POST['ffin'];
    //echo $ini;
    //echo $fin;
    $sql = "SELECT cliente.id as idc, cliente.nomcli, servicio.tipo, servicio.id as ids, unidades.noserie, unidades.nomuni, unidades.marca, unidades.modelo, unidades.placas, orden_servicio.id as ido, orden_servicio.fecha_inicial, orden_servicio.fecha_final, orden_servicio.hora_inicial, orden_servicio.hora_final, orden_servicio.kilometraje, orden_servicio.marcandia_transportar, orden_servicio.dirrecoleccion, orden_servicio.direntrega, orden_servicio.hrecoleccion, orden_servicio.hrcita, orden_servicio.ciudaddestino FROM orden_servicio INNER JOIN cliente ON cliente.id=orden_servicio.idcli INNER JOIN unidades on unidades.noserie=orden_servicio.iduni INNER JOIN servicio ON servicio.id=orden_servicio.idservi WHERE orden_servicio.altaactivi BETWEEN '$ini' AND '$fin'";
    $result = mysqli_query($link,$sql);
    while($fila = mysqli_fetch_array($result)) {
        $arregloReport[]=$fila;
    }
  }
  if($_POST['consutla']=="fechaRangoUnidad"){
    $ini=$_POST['fini'];
    $fin=$_POST['ffin'];
    $uni=$_POST['uni'];
    //echo $ini;
    //echo $fin;
    $sql = "SELECT cliente.id as idc, cliente.nomcli, servicio.tipo, servicio.id as ids, unidades.noserie, unidades.nomuni, unidades.marca, unidades.modelo, unidades.placas, orden_servicio.id as ido, orden_servicio.fecha_inicial, orden_servicio.fecha_final, orden_servicio.hora_inicial, orden_servicio.hora_final, orden_servicio.kilometraje, orden_servicio.marcandia_transportar, orden_servicio.dirrecoleccion, orden_servicio.direntrega, orden_servicio.hrecoleccion, orden_servicio.hrcita, orden_servicio.ciudaddestino FROM orden_servicio INNER JOIN cliente ON cliente.id=orden_servicio.idcli INNER JOIN unidades on unidades.noserie=orden_servicio.iduni INNER JOIN servicio ON servicio.id=orden_servicio.idservi WHERE orden_servicio.fecha_inicial>='$ini' AND orden_servicio.fecha_final<='$fin' and orden_servicio.iduni=$uni";
    $result = mysqli_query($link,$sql);
    while($fila = mysqli_fetch_array($result)) {
        $arregloReport[]=$fila;
    }
  }

  if($_POST['consutla']=="fechaRangoCliente"){
    $ini=$_POST['fini'];
    $fin=$_POST['ffin'];
    $cli=$_POST['cli'];
    //echo $ini;
    //echo $fin;
    $sql = "SELECT cliente.id as idc, cliente.nomcli, servicio.tipo, servicio.id as ids, unidades.noserie, unidades.nomuni, unidades.marca, unidades.modelo, unidades.placas, orden_servicio.id as ido, orden_servicio.fecha_inicial, orden_servicio.fecha_final, orden_servicio.hora_inicial, orden_servicio.hora_final, orden_servicio.kilometraje, orden_servicio.marcandia_transportar, orden_servicio.dirrecoleccion, orden_servicio.direntrega, orden_servicio.hrecoleccion, orden_servicio.hrcita, orden_servicio.ciudaddestino FROM orden_servicio INNER JOIN cliente ON cliente.id=orden_servicio.idcli INNER JOIN unidades on unidades.noserie=orden_servicio.iduni INNER JOIN servicio ON servicio.id=orden_servicio.idservi WHERE orden_servicio.fecha_inicial>='$ini' AND orden_servicio.fecha_final<='$fin' and and orden_servicio.idcli=$cli";
    $result = mysqli_query($link,$sql);
    while($fila = mysqli_fetch_array($result)) {
        $arregloReport[]=$fila;
    }
  }

  if($_POST['consutla']=="fechames"){
    $ini=$_POST['fmes']."-01";
    

    $numMes = date("m", strtotime($_POST['fmes'])); 
    if($numMes=="01"|| $numMes=="03"|| $numMes=="05" || $numMes=="07" || $numMes=="08"|| $numMes=="10"|| $numMes=="12"){
        $fin=$_POST['fmes']."-31";
    }
    if($numMes=="02"){
        $fin=$_POST['fmes']."-28";
    }
    if($numMes=="04"|| $numMes=="06" || $numMes=="09" || $numMes=="11" ){
        $fin=$_POST['fmes']."-30";
    }
    $sql = "SELECT cliente.id as idc, cliente.nomcli, servicio.tipo, servicio.id as ids, unidades.noserie, unidades.nomuni, unidades.marca, unidades.modelo, unidades.placas, orden_servicio.id as ido, orden_servicio.fecha_inicial, orden_servicio.fecha_final, orden_servicio.hora_inicial, orden_servicio.hora_final, orden_servicio.kilometraje, orden_servicio.marcandia_transportar, orden_servicio.dirrecoleccion, orden_servicio.direntrega, orden_servicio.hrecoleccion, orden_servicio.hrcita, orden_servicio.ciudaddestino FROM orden_servicio INNER JOIN cliente ON cliente.id=orden_servicio.idcli INNER JOIN unidades on unidades.noserie=orden_servicio.iduni INNER JOIN servicio ON servicio.id=orden_servicio.idservi WHERE orden_servicio.altaactivi BETWEEN '$ini' AND '$fin'";
    $result = mysqli_query($link,$sql);
    while($fila = mysqli_fetch_array($result)) {
        $arregloReport[]=$fila;
    }
    
  }
 
 if(empty($arregloReport)){?>
          <tr class="color_rojo_suave">
          <td class="text-center" ><a  class="rojo_obscuro"></a></td>
          <td class="text-center"> <a  class="rojo_obscuro"></a> </td>
          <td class="text-center">
            <p></p></td>
          <td class="text-center">
            <p>No tiene Reportes</p>
          </td>
          <td class="text-center">
            <p></p>
        </td>
        <td class="text-center">
         

        </td>
        </tr>
 <?php }else{

   foreach ($arregloReport as $row) { 
    ?>
        <tr class="color_rojo_suave">
          <td class="text-center" ><a href="reportes_detalles.php?ids=<?php echo $row['ido']; ?>" class="rojo_obscuro"><i class="fas fa-eye"></i></a></td>
          <td class="text-center"> <a  class="rojo_obscuro"><?php echo $row['tipo']; ?></a> </td>
          <td class="text-center">
            <p><?php echo $row['nomcli']; ?></p></td>
          <td class="text-center">
            <p><?php echo $row['nomuni']; ?></p>
          </td>
           <td class="text-center">
            <p><?php echo $row['fecha_inicial']; ?></p>
        </td>
        <td class="text-center">
        <p><?php echo $row['fecha_final']; ?></p>
         
       
        </td>
       
        </tr>
       
       
        <?php } 
 }


?>