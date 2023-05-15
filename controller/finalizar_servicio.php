<?php
    include ("../model/model_servicios.php");
    include ("../model/liga_BD.php");
    if(isset($_POST['finalizar_calendario'])){ 
        $uni_id=$_POST['uni_id'];
        $fecha_inicial=$_POST['fecha_inicial'];
        $fecha_fin=$_POST['fecha_fin'];
        $tipo_servicio=$_POST['tipo_servicio'];
        $cliente=$_POST['cliente'];
        if($tipo_servicio==4){
            $consulta =  new consul();
            $resultado = $consulta->mantenimiento_finalizado($uni_id, $fecha_inicial, $fecha_fin, $tipo_servicio);
        }else{
            $consulta =  new consul();

            $sql="DELETE FROM calendariogeneral WHERE fechafin='$fecha_fin' AND iduni=".$uni_id;
            $result=mysqli_query($link,$sql);
            
            $consulta->editarStatusFinalizado($uni_id,1,"0000-00-00");
            $resultado = $consulta->orden_servicio_finalizado($uni_id, $fecha_inicial, $fecha_fin, $tipo_servicio, $cliente);
        }
    }
?>