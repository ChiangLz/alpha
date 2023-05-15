<?php
    include ("../model/model_servicios.php");
    if(isset($_POST['deleted_calendario'])){ 
        $uni_id=$_POST['uni_id'];
        $fecha_inicial=$_POST['fecha_inicial'];
        $fecha_fin=$_POST['fecha_fin'];
        $tipo_servicio=$_POST['tipo_servicio'];
        $cliente=$_POST['cliente'];
        if($tipo_servicio==4){
            $consulta =  new consul();
            $resultado = $consulta->mantenimiento($uni_id, $fecha_inicial, $fecha_fin, $tipo_servicio);
        }else{
            $consulta =  new consul();
            $resultado = $consulta->orden_servicio($uni_id, $fecha_inicial, $fecha_fin, $tipo_servicio, $cliente);
        }
    }
?>