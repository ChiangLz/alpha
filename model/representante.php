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

    public function representantesuc($idr){
        $consulta=$this->db->query("SELECT * FROM representante WHERE id=$idr");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function colaboradores($idc){
        $consulta=$this->db->query("SELECT nomcol, idrol, cuenta FROM colaboradores WHERE id=$idc");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function sucursal($ids){
        $consulta=$this->db->query("SELECT * FROM sucursal WHERE id=$ids");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }

    public function edit_representante($idrepre,$idsuc,$contacto,$correocont,$nomcli,$telcli,$celular,$ine,$correocli,$dircli,
    $razonsocial,$dirsocial,
    $colonia,$ciudad,$estado,$cp,$rfc,$correofac){
        $edit_unid = $this->db->query("UPDATE representante SET id=$idrepre,nomrepre='$contacto',correorepre='$correocont',
        contactorepre='$nomcli',telrepre='$telcli',celularrepre='$celular',ine='$ine',dirrepre='$dircli',
        razonsocialrepre='$razonsocial',
        dirsocialrepre='$dirsocial',coloniarepre='$colonia',ciudadrepre='$ciudad',estadorepre='$estado',
        corepre='$correocli',cp='$cp',rfcrepre='$rfc',correreprefac='$correofac',idsuc=$idsuc WHERE id=$idrepre");
        
        echo '<script type="text/javascript">
       alert("Representante actualizado exitosamente");
       window.location.href="../views/sucursales_edicion_suc.php?id='.$idsuc.'";
       </script>';
    }

}

?>