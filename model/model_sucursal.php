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

    public function sucursal($ids){
        $consulta=$this->db->query("SELECT * FROM sucursal WHERE id=$ids");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function sucursaladm1(){
        $consulta=$this->db->query("SELECT * FROM sucursal WHERE id<=3");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function sucursaladm2(){
        $consulta=$this->db->query("SELECT * FROM sucursal WHERE id>=4 AND id<=5 ");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function representante($ids){
        $consulta=$this->db->query("SELECT * FROM representante WHERE idsuc=$ids");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function colaboradorSucIc($idsuc){
        $consulta=$this->db->query("SELECT colaboradores.id as idcol, colaboradores.nomcol, colaboradores.cuenta, colaboradores.fechacol, rol.tipo_rol,sucursal.id as idsuc  from colaboradores INNER JOIN sucursal_colaborador on colaboradores.id=sucursal_colaborador.idcol INNER JOIN sucursal on sucursal.id=sucursal_colaborador.idsuc INNER JOIN rol ON colaboradores.idrol=rol.id WHERE sucursal.id=$idsuc AND rol.tipo_rol!='SuperAdministrador'");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function colaboradores($idc){
        $consulta=$this->db->query("SELECT nomcol, idrol , cuenta FROM colaboradores WHERE id=$idc");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function colaborador($id){
        $consulta=$this->db->query("SELECT colaboradores.id as idcols, colaboradores.nomcol as nomc, colaboradores.contra as contra, rol.tipo_rol as tipo_rol, rol.id as id_rol, colaboradores.fechacol as fcol, colaboradores.correo as correocol, colaboradores.cuenta as cuecol, sucursal.id as idsc FROM colaboradores INNER JOIN rol ON rol.id=colaboradores.idrol INNER JOIN sucursal_colaborador on sucursal_colaborador.idcol=colaboradores.id INNER JOIN sucursal ON sucursal.id=sucursal_colaborador.idsuc WHERE colaboradores.id=$id");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function rol()
    {
        $rol = $this->db->query("SELECT rol.id as id_rol, rol.tipo_rol as tipo_rol FROM rol WHERE rol.id<>1 AND rol.id<>2");
        while ($filas = $rol->fetch_assoc()) {
            $this->lista[] = $filas;
        }
        return $this->lista;
    }
    public function roladm()
    {
        $rol = $this->db->query("SELECT rol.id as id_rol, rol.tipo_rol as tipo_rol FROM rol WHERE rol.id<>1");
        while ($filas = $rol->fetch_assoc()) {
            $this->lista[] = $filas;
        }
        return $this->lista;
    }
    public function edit_colaborador($idsuc,$idcola,$nomcola,$fecha,$correo,$cuenta,$contracola,$id_rol)
    {
        $edit_col = $this->db->query("UPDATE colaboradores SET id=$idcola, nomcol='$cuenta',fechacol='$fecha',correo='$correo',cuenta='$nomcola',contra='$contracola',idrol=$id_rol WHERE id =$idcola");
        echo '<script type="text/javascript">
       alert("Los datos se realizaron correctamente");
       window.location.href="../views/sucursales_detalle.php?ids='.$idsuc.'";
       </script>';
    }
    public function edit_sucursal($id,$nom,$dir,$tel,$cp,$estado)
    {
        $edit_col = $this->db->query("UPDATE sucursal SET id=$id,nomsuc='$nom',dirsuc='$dir',telsuc='$tel',cp='$cp',estado='$estado' WHERE id=$id");
        echo '<script type="text/javascript">
       alert("Los datos se realizaron correctamente");
       window.location.href="../views/sucursales_detalle.php?ids='.$id.'"; </script>';
    }
    public function nomcolaboradorx($idc){
        $consulta=$this->db->query("SELECT idrol as rolid FROM colaboradores WHERE id=$idc");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }

}

?>