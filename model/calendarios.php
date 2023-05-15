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
    public function nomcolaborador($idc){
        $sql = "SELECT nomcol, idrol, cuenta FROM colaboradores WHERE id=$idc";
        
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function calendario_actividad($fecha, $idsuc){
        $sql = "SELECT * FROM calendario WHERE idscr = '$idsuc' AND estado = 'ocupado' AND (fechaini <= '$fecha' AND fechafin >= '$fecha')";
        #echo $sql;
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function calendario_mate($idun,$idse,$fi,$ff){
        $sql = "SELECT mantenimiento.tipo, mantenimiento.fecha_inicio, mantenimiento.fecha_final, mantenimiento.gastos, mantenimiento.descripcion, unidades.marca, unidades.modelo, unidades.noserie, unidades.serie,unidades.nomuni, servicio.tipo as tipos, servicio.color, servicio.id FROM calendario INNER JOIN mantenimiento ON mantenimiento.idservi=calendario.idserv AND mantenimiento.fecha_inicio=calendario.fechaini AND mantenimiento.fecha_final=calendario.fechafin AND mantenimiento.idunid=calendario.iduni INNER JOIN unidades ON unidades.noserie=calendario.iduni INNER JOIN servicio on servicio.id=calendario.idserv 
        WHERE calendario.iduni=$idun AND calendario.idserv=$idse AND calendario.fechaini='$fi' AND calendario.fechafin='$ff'";
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function calendario_servi_all($fi, $ff, $idun, $idsuc){
        $fecahinicial = date("Y-m-d", strtotime("$fi"));
        $fechafinal = date("Y-m-d", strtotime("$ff"));
        $sql="SELECT DISTINCT servicio.id as ids,servicio.tipo as tips, unidades.noserie, unidades.marca, unidades.modelo, unidades.nomuni, unidades.placas, cliente.id as idc ,cliente.nomcli, cliente.celular, orden_servicio.fecha_inicial, orden_servicio.fecha_final, orden_servicio.dirrecoleccion 
        FROM calendario INNER JOIN orden_servicio on orden_servicio.idcli=calendario.idclient AND orden_servicio.iduni=calendario.iduni AND orden_servicio.idservi=calendario.idserv AND orden_servicio.fecha_inicial=calendario.fechaini AND orden_servicio.fecha_final=calendario.fechafin INNER JOIN unidades ON unidades.noserie=calendario.iduni INNER JOIN servicio on servicio.id=calendario.idserv INNER JOIN cliente on cliente.id=calendario.idclient 
        WHERE calendario.idscr = $idsuc AND calendario.fechaini = '$fecahinicial' AND calendario.fechafin = '$fechafinal' AND calendario.iduni = $idun";
        #echo $sql;
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }

}

?>