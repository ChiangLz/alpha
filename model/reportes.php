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
    public function nomsucursal($ids){
        $consulta=$this->db->query("SELECT b.nomsuc, b.id as idsuc FROM sucursal as b WHERE b.id=$ids");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
   
    public function nomcolaborador($idc){
        $consulta=$this->db->query("SELECT nomcol, idrol, cuenta FROM colaboradores WHERE id=$idc");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function cliente_sucursal($ids){
        $consulta=$this->db->query("SELECT cliente.id as idc, cliente.nomcli FROM cliente INNER JOIN sucursal ON cliente.idsucur=sucursal.id WHERE idsucur=$ids");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function cliente_sucursaladm(){
        $consulta=$this->db->query("SELECT cliente.id as idc, cliente.nomcli FROM cliente INNER JOIN sucursal ON cliente.idsucur=sucursal.id");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function unidad_sucursal($ids){
        $consulta=$this->db->query("SELECT noserie, nomuni FROM unidades WHERE idsuc=$ids");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function unidad_sucursaladm(){
        $consulta=$this->db->query("SELECT noserie, nomuni FROM unidades");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function reportes_sucursales($ids){
        $consulta=$this->db->query("SELECT cliente.id as idc, cliente.nomcli, servicio.tipo, servicio.id as ids, unidades.noserie, unidades.nomuni, unidades.marca, unidades.modelo, unidades.placas, orden_servicio.id as ido, orden_servicio.fecha_inicial, orden_servicio.fecha_final, orden_servicio.hora_inicial, orden_servicio.hora_final, orden_servicio.kilometraje, orden_servicio.marcandia_transportar, orden_servicio.dirrecoleccion, orden_servicio.direntrega, orden_servicio.hrecoleccion, orden_servicio.hrcita, orden_servicio.ciudaddestino FROM orden_servicio INNER JOIN cliente ON cliente.id=orden_servicio.idcli INNER JOIN unidades on unidades.noserie=orden_servicio.iduni INNER JOIN servicio ON servicio.id=orden_servicio.idservi WHERE orden_servicio.idsucur=$ids");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function reportes_sucursalesid($idr){
        $consulta=$this->db->query("SELECT cliente.id as idc, cliente.nomcli, orden_servicio.costo, servicio.tipo, servicio.id as ids, unidades.noserie, unidades.nomuni, unidades.marca, disponibilidad.nomdispo, unidades.modelo, unidades.placas, orden_servicio.id as ido, orden_servicio.fecha_inicial, orden_servicio.fecha_final, orden_servicio.hora_inicial, orden_servicio.hora_final, orden_servicio.kilometraje, orden_servicio.marcandia_transportar, orden_servicio.dirrecoleccion, orden_servicio.direntrega, orden_servicio.hrecoleccion, orden_servicio.hrcita, orden_servicio.ciudaddestino FROM orden_servicio INNER JOIN cliente ON cliente.id=orden_servicio.idcli INNER JOIN unidades on unidades.noserie=orden_servicio.iduni INNER JOIN servicio ON servicio.id=orden_servicio.idservi INNER JOIN disponibilidad ON unidades.iddispo=disponibilidad.id WHERE orden_servicio.id=$idr");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function reportes_sucursalesadm(){
        $consulta=$this->db->query("SELECT cliente.id as idc, cliente.nomcli, servicio.tipo, servicio.id as ids, unidades.noserie, unidades.nomuni, unidades.marca, unidades.modelo, unidades.placas, orden_servicio.id as ido, orden_servicio.fecha_inicial, orden_servicio.fecha_final, orden_servicio.hora_inicial, orden_servicio.hora_final, orden_servicio.kilometraje, orden_servicio.marcandia_transportar, orden_servicio.dirrecoleccion, orden_servicio.direntrega, orden_servicio.hrecoleccion, orden_servicio.hrcita, orden_servicio.ciudaddestino FROM orden_servicio INNER JOIN cliente ON cliente.id=orden_servicio.idcli INNER JOIN unidades on unidades.noserie=orden_servicio.iduni INNER JOIN servicio ON servicio.id=orden_servicio.idservi");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }

}
?>