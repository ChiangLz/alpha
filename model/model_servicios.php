<?php
include 'conexion.php';
class consul{
    private $db;//database
    private $lista;
    private $prov;
    private $tbl;

    public function __construct(){
        $this->db=conexion::con();
        $this->lista=array();
    }
    public function select_cliente($ids){
        $consulta=$this->db->query("SELECT * FROM cliente WHERE idsucur=$ids");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }

    public function select_cliente2(){
        $result =$this->db->query("SELECT * FROM cliente");

        while($filas=$result->fetch_assoc()){
            $this->lista[]=$filas['contacto'];
        }
        return $this->lista;
        return $equipo;
    }
    
    public function select_unidad($ids){
        $consulta=$this->db->query("SELECT * FROM unidades WHERE idsuc=$ids");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function select_unidadadm(){
        $consulta=$this->db->query("SELECT * FROM unidades ");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function select_servicios(){
        $consulta=$this->db->query("SELECT * FROM servicio WHERE servicio.tipo <> 'mantenimiento'");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
   
    public function nomcolaborador($idc){
        $consulta=$this->db->query("SELECT id, nomcol, idrol, cuenta FROM colaboradores WHERE id=$idc");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function nomsucursal($ids){
        $consulta=$this->db->query("SELECT b.nomsuc, b.id as idsuc FROM sucursal as b WHERE b.id=$ids");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function add_servicios($idc,$ids,$select_cliente,$select_servicio,$select_unidad,$fecha_inicial,$fecha_final,$timeI,$timeF,$select_transportar,$kilometraje,$monto_deposito,$valor_pagare,$direcol,$direntrega,$cddes,$timeR,$timeC,$costoser,$fachaActual){
        $fecha = date('Y-m-d');
        $variables = "'" . $idc . "," . $ids . "," . $select_cliente . "," . $select_servicio . "," . $select_unidad . "," . $fecha_inicial . "," . $fecha_final . "," . $timeI . "," . $timeF . "," . $select_transportar . "," . $kilometraje . "," . $monto_deposito . "," . $valor_pagare . "," . $direcol . "," . $direntrega . "," . $cddes . "," . $timeR . "," . $timeC . "," . $costoser . "," . $fachaActual . "'";
        $sql = "INSERT INTO debug(id, function_name, date_in, variables) values
        ('', 'add_servicios', '$fecha', $variables)";
        //$insert_debug=$this->db->query($sql);
        /* $dini = date("d", strtotime("$fecha_inicial"));
        $dfin = date("d", strtotime("$fecha_final"));
        $mini = date("Y-m", strtotime("$fecha_inicial"));   
        for ($i=$dini; $i <=$dfin; $i++) { */
        date_default_timezone_set('America/Mexico_City');
        $sql = "INSERT INTO orden_servicio(idservi, idcli, iduni, fecha_inicial, fecha_final, hora_inicial, hora_final, kilometraje, monto_deposito, valor_pagare, marcandia_transportar, idsucur, idcol, dirrecoleccion, direntrega, hrecoleccion, hrcita, ciudaddestino, costo, altaactivi, folio)".
        "VALUES ($select_servicio,$select_cliente,$select_unidad,'$fecha_inicial','$fecha_final','$timeI','$timeF','$kilometraje','$monto_deposito','$valor_pagare','$select_transportar',$ids,$idc,'$direcol','$direntrega','$timeR','$timeC','$cddes','$costoser','$fachaActual', 'null')";
        
        $alta_servicios = $this->db->query($sql);
        // } 
        $mes = date('m');
        $dia = date('d');
        $consulta= $this->db->query("SELECT folio, idservi AS clave, id FROM orden_servicio WHERE id = (SELECT MAX(id) AS id FROM orden_servicio)");
        $latest_id=$consulta->fetch_assoc();
        $id = $latest_id['id'];
        #$id="".(int) $rest."";
        #$id=$id+1;
        if($latest_id['clave']==3){
            $folio=null;
        }else{
            if($latest_id['clave']==1){ //Tipo de servicio Flete
                switch($id){
                    case $id<=9:
                        $folio="F".$mes.$dia."0000".$id;
                    break;
                    case $id<=99:
                        $folio="F".$mes.$dia."000".$id;
                    break;
                    case $id<=999:
                        $folio="F".$mes.$dia."00".$id;
                    break;
                    case $id<=9999:
                        $folio="F".$mes.$dia."0".$id;
                    break;
                    case $id<=9999:
                        $folio="F".$mes.$dia.$id;
                    break;
                    default:
                        $folio="F".$mes.$dia."00001";
                    break;
                }
            }else{ //Tipo de servicio Renta
                switch($id){
                    case $id<=9:
                        $folio="R".$mes.$dia."0000".$id;
                    break;
                    case $id<=99:
                        $folio="R".$mes.$dia."000".$id;
                    break;
                    case $id<=999:
                        $folio="R".$mes.$dia."00".$id;
                    break;
                    case $id<=9999:
                        $folio="R".$mes.$dia."0".$id;
                    break;
                    case $id<=9999:
                        $folio="R".$mes.$dia.$id;
                    break;
                    default:
                        $folio="R".$mes.$dia."00001";
                    break;
                }
            }
        }

        $update_folio=$this->db->query("UPDATE orden_servicio SET folio='$folio' WHERE id=$id");
        echo 'Documento Generado exitosamente';

    }


    public function editarStatus($select_unidad,$nomuni,$serie,$fecha_alta,$marca,$modelo,$placas,$caja,$refrigeracion,$capacidadmac,$costo,$descripcion,$foto,$dipocision,$tipo,$idsuc,$fecha_final){
        $fecha = date('Y-m-d');
        $variables = "'" . $select_unidad . "," . $nomuni . "," . $serie . "," . $fecha_alta . "," . $marca . "," . $modelo . "," . $placas . "," . $caja . "," . $refrigeracion . "," . $capacidadmac . "," . $costo . "," . $descripcion . "," . $foto . "," . $dipocision . "," . $tipo . "," . $idsuc . "," . $fecha_final . "'";
        $sql = "INSERT INTO debug(id, function_name, date_in, variables) values
        ('', 'editarStatus', '$fecha', $variables)";
        $insert_debug=$this->db->query($sql);


        $consulta=$this->db->query("UPDATE unidades SET noserie='$select_unidad', nomuni='$nomuni',serie='$serie',fecha_alta='$fecha_alta',marca='$marca',modelo='$modelo',placas='$placas',caja='$caja',refrigeracion='$refrigeracion',capasidad_max='$capacidadmac',costo_adquisicion='$costo',descripuni='$descripcion',foto='$foto',iddispo=$dipocision,tipo='$tipo',idsuc=$idsuc, ultimaactividad='$fecha_final' WHERE noserie=$select_unidad");
    }
    public function editarStatusFinalizado($select_unidad,$dipocision,$fecha_final){
        $consulta=$this->db->query("UPDATE unidades SET iddispo=$dipocision, ultimaactividad='$fecha_final'  WHERE noserie=$select_unidad");   
    }
    public function add_mantenimiento($mante,$Inifecha,$Finfecha,$dispo,$gastos,$otromante,$idu,$descripcion,$select_servicio,$ids){
       /* $dini = date("d", strtotime("$Inifecha"));
       
        $dfin = date("d", strtotime("$Finfecha"));
        $mini = date("Y-m", strtotime("$Finfecha"));

   
        for ($i=$dini; $i <=$dfin; $i++) { */
        
        $alta_servicios = $this->db->query("INSERT INTO mantenimiento(id, tipo, fecha_inicio, fecha_final, afec_disponiilidad, gastos, actividad, idunid,descripcion,idservi,idsucr) 
        VALUES (null,'$mante','$Inifecha','$Finfecha','$dispo','$gastos','$otromante',$idu,'$descripcion',$select_servicio,$ids)");
      // }
        $arr = array(
            'mensaje'=>'Mantenimiento Guardado exitosamente',
            'idu'=>0
        );
        echo json_encode($arr);
        //echo 'Mantenimiento Guardado exitosamente';
    }
    public function add_calendario($serv,$fachaActual,$timeI,$select_unidad,$timeF,$fecha_inicial,$fecha_final,$select_servicio,$select_cliente,$ids){
        $fecha = date('Y-m-d');
        $variables = "'" . $serv . "," . $fachaActual . "," . $timeI . "," . $select_unidad . "," . $timeF . "," . $fecha_inicial . "," . $fecha_final . "," . $select_servicio . "," . $select_cliente . "," . $ids . "'";
        $sql = "INSERT INTO debug(id, function_name, date_in, variables) values
        ('', 'add_calendario', '$fecha', $variables)";
        $insert_debug=$this->db->query($sql);

        $sql = "INSERT INTO calendario(id, actividad, altaactividad, horaini, iduni, horafin, fechaini, fechafin, idserv, idclient,idscr,estado) 
        VALUES (null,'$serv','$fachaActual','$timeI',$select_unidad,'$timeF','$fecha_inicial','$fecha_final',$select_servicio,$select_cliente,$ids,'ocupado')";
        $alta_calendario = $this->db->query($sql);
        
    }


    public function add_calendariogeneral($serv,$fachaActual,$select_unidad,$fecha_inicial,$fecha_final,$select_servicio,$select_cliente,$ids,$timeF){
        $fecha = date('Y-m-d');
        $variables = "'" . $serv . "," . $fachaActual . "," . $select_unidad . "," . $fecha_inicial . "," . $fecha_final . "," . $select_servicio . "," . $select_cliente . "," . $ids . "," . $timeF . "'";
        $sql = "INSERT INTO debug(id, function_name, date_in, variables) values
        ('', 'add_calendario_general', '$fecha', $variables)";
        $insert_debug=$this->db->query($sql);
       
        $dini = date("Y-m-d", strtotime("$fecha_inicial"));
        $dfin = date("Y-m-d", strtotime("$fecha_final"));
        $mini = date("Y-m", strtotime("$fecha_inicial"));
        $firstDate  = new DateTime($dini);
        $secondDate = new DateTime($dfin);
        $tosavedate = $firstDate->format('Y-m-d');
        #$intvl = $firstDate->diff($secondDate);

        $sql = "INSERT INTO calendariogeneral(id, activiadad, altaactividad, iduni, fechaini, fechafin, idserv, idclient, idscr, horafin) 
                                      VALUES (null,'$serv','$fachaActual',$select_unidad,'".$tosavedate."','$fecha_final',$select_servicio,$select_cliente,$ids,'$timeF')";
        $alta_calendario = $this->db->query($sql);

        #for ($i=0; $i <= $intvl->days ; $i++) { 
        #    
        #    
        #    $tosavedate = date("Y-m-d",strtotime($tosavedate."+ 1 days")); 
#
        #}
        
    }
    public function edit_unidades1($valorsuc,$nomuni,$serie,$fecha_alta,$marca,$modelo,
    $placas,$caja,$refrigeracion,$capacidadmac,$costo,
    $descripcion,$foto,$tipo,$idsuc,$disposicion,$ultimaactividad){
        $edit_unid = $this->db->query("UPDATE unidades SET noserie=$valorsuc, nomuni='$nomuni',serie='$serie',
        fecha_alta='$fecha_alta',marca='$marca',modelo='$modelo',placas='$placas',caja='$caja',refrigeracion='$refrigeracion',
        capasidad_max='$capacidadmac',costo_adquisicion='$costo',descripuni='$descripcion',foto='$foto',iddispo=$disposicion,
        tipo='$tipo',idsuc=$idsuc, ultimaactividad='$ultimaactividad' WHERE noserie=$valorsuc");
        
        echo '¡La Disponibilidad de la Unidad es DISPOBIBLE!';
    }


    public function diasOcupados()
    {
       
        echo 'La unidad esta Ocupada';
    }

    public function diasOcupados1($idu)
    {
        
        $arr = array(
            'mensaje'=>'La unidad esta Ocupada',
            'idu'=>$idu
       );
       echo json_encode($arr);
    }

    public function mantenimiento($uni_id, $fecha_inicial, $fecha_fin, $tipo_servicio){
        $cat_actividades = $this->db->query("DELETE FROM calendario WHERE iduni=$uni_id and fechaini='$fecha_inicial' AND fechafin='$fecha_fin' AND idserv=$tipo_servicio");

        echo 'Mantenimiento eliminado correctamente.';
    }

    public function mantenimiento_finalizado($uni_id, $fecha_inicial, $fecha_fin, $tipo_servicio){
        $cat_actividades = $this->db->query("UPDATE calendario SET estado='finalizado' WHERE iduni=$uni_id and fechaini='$fecha_inicial' AND fechafin='$fecha_fin' AND idserv=$tipo_servicio");
        editarStatusFinalizado($uni_id,1);
        echo 'Mantenimiento Finalizado correctamente.';
    }

    public function orden_servicio($uni_id, $fecha_inicial, $fecha_fin, $tipo_servicio, $cliente){
        $cat_actividades = $this->db->query("DELETE FROM calendario WHERE iduni=$uni_id and fechaini='$fecha_inicial' AND fechafin='$fecha_fin' AND idserv=$tipo_servicio AND idclient=$cliente");

        echo 'Servicio eliminado correctamente.';
    }

    public function orden_servicio_finalizado($uni_id, $fecha_inicial, $fecha_fin, $tipo_servicio, $cliente){
        $cat_actividades = $this->db->query("UPDATE calendario SET estado='finalizado' WHERE iduni=$uni_id and fechaini='$fecha_inicial' AND fechafin='$fecha_fin' AND idserv=$tipo_servicio AND idclient=$cliente");
        echo 'Servicio finalizado correctamente.';
    }
}
?>