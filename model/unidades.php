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

    public function disponibilidad($ids, $iduni){
        date_default_timezone_set('America/Mexico_City');
        $actual=date('Y-m-d');
        $sql = "SELECT idserv, estado FROM `calendario` WHERE idscr=$ids and iduni=$iduni and '$actual' BETWEEN fechaini and fechafin and estado = 'ocupado'";
        
        $consulta=$this->db->query($sql);
        $filas=$consulta->fetch_assoc();
        return $filas;
    }
    public function unidadessuc($ids){
        $sql = "SELECT unidades.noserie, unidades.nomuni, unidades.serie, unidades.fecha_alta, unidades.iddispo , unidades.ultimaactividad, unidades.idsuc FROM unidades WHERE idsuc=$ids";
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function unidadessuc1($ids){
        $consulta=$this->db->query("SELECT unidades.noserie, unidades.nomuni, unidades.serie, unidades.fecha_alta, bajas.descripcion, bajas.valor, bajas.baja FROM bajas INNER JOIN unidades ON unidades.noserie=bajas.idunidad WHERE bajas.suc=$ids");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function unidadessuc1adm(){
        $consulta=$this->db->query("SELECT unidades.noserie, unidades.nomuni, unidades.serie, unidades.fecha_alta, bajas.descripcion, bajas.valor, bajas.baja FROM bajas INNER JOIN unidades ON unidades.noserie=bajas.idunidad");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function unidadesadm(){
        $consulta=$this->db->query("SELECT unidades.noserie, unidades.nomuni,unidades.serie, unidades.fecha_alta, unidades.iddispo FROM unidades ");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function unidadesid($id){
        $consulta=$this->db->query("SELECT * FROM unidades WHERE noserie=".$id);
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function fecha($ids){
        $sql = "SELECT  fechaini, fechafin, idserv, estado FROM calendario WHERE idscr=$ids";
        
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function fecha_cal($ids, $m){

        $sql_to_update_status = "UPDATE calendario SET estado='finalizado' WHERE fechafin < CURDATE()";
        $update = $this->db->query($sql_to_update_status);
        $mactual = date("m");
        if($m > $mactual){
            $sql = "SELECT DISTINCT fechaini, fechafin, idserv, estado FROM calendario WHERE idscr=$ids AND estado = 'ocupado'AND ( MONTH(fechaini) <= $m AND MONTH(fechafin) >= $m)";
        }
        if($m == $mactual){
            $sql = "SELECT DISTINCT fechaini, fechafin, idserv, estado FROM calendario WHERE idscr=$ids AND estado = 'ocupado'AND ( MONTH(fechaini) <= $m OR MONTH(fechafin) >= $m)";
        }
        if($m < $mactual){
            $sql = "SELECT DISTINCT fechaini, fechafin, idserv, estado FROM calendario WHERE idscr=$ids AND estado = 'ocupado'AND ( MONTH(fechaini) = $m AND MONTH(fechafin) >= $m)";
        }
        #echo $sql;
        $consulta=$this->db->query($sql);
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function fecha2($anio1, $anio2,$ids){
        $consulta=$this->db->query("SELECT fechaini, fechafin, idserv FROM calendario WHERE fechaini >='$anio1' AND fechafin<='$anio2' AND idscr =$ids");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function todos_unidades($ids){
        $consulta=$this->db->query("SELECT * FROM unidades WHERE iddispo!=5 and idsuc=$ids");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function nomsucursal($ids){
        $consulta=$this->db->query("SELECT * FROM sucursal WHERE id=$ids");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function nomsucursaladm(){
        $consulta=$this->db->query("SELECT * FROM sucursal ");
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
    public function nomsucursaluto($id){
        $consulta=$this->db->query("SELECT sucursal.nombre as nomsuc FROM unidades INNER JOIN sucursal ON unidades.idsuc=sucursal.id WHERE unidades.noserie=$id");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function servicios($id){
        $consulta=$this->db->query("SELECT * FROM orden_servicio WHERE iduni=$id");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function add_unidades($nombre,$fecha,$marca,$modelo,$numserie,$placas,$caja,$refrigeracion,$capasidad,$costo,$comentario,$idsucursal,$ruta_img,$actividad,$tipo)
    {
        $alta_unidades = $this->db->query("INSERT INTO unidades(noserie, nomuni, serie, fecha_alta, marca, modelo, placas, caja, refrigeracion, capasidad_max, costo_adquisicion, descripuni, foto, iddispo, tipo, idsuc,ultimaactividad) 
        VALUES (null,'$nombre','$numserie','$fecha','$marca','$modelo','$placas','$caja','$refrigeracion','$capasidad','$costo','$comentario','$ruta_img',1,'$tipo',$idsucursal,'$actividad')");
       echo '<script type="text/javascript">
       alert("Unidad agregado exitosamente");
       window.location.href="../views/unidades.php";
       </script>';
    }
    public function manteniminetoidu($id){
        $consulta=$this->db->query("SELECT * FROM mantenimiento WHERE idunid=$id");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }

    public function edit_unidades($nombre,$fecha,$marca,$modelo,$numserie,$placas,$caja,$refrigeracion,$capasidad,$costo,$comentario,$idsucursal,$ruta_img,$idunidad,$disponiilidad,$tipo,$activi){
        $edit_unid = $this->db->query("UPDATE unidades SET noserie=$idunidad, nomuni='$nombre',serie='$numserie',fecha_alta='$fecha',marca='$marca',modelo='$modelo',placas='$placas',caja='$caja',refrigeracion='$refrigeracion',capasidad_max='$capasidad',costo_adquisicion='$costo',descripuni='$comentario',foto='$ruta_img',iddispo=$disponiilidad,tipo='$tipo',idsuc=$idsucursal, ultimaactividad='$activi' WHERE noserie=$idunidad");
        
        echo '<script type="text/javascript">
       alert("Unidad actualizado exitosamente");
       window.location.href="../views/unidades.php";
       </script>';
    }
   

}

?>