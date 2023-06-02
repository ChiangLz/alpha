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

    public function add_sucursal(
        $name_suc,$phone_suc,$cp_suc,$state_suc,$address_suc,
        $contacto,$correocont,$nomcli,$telcli,$celular,$ine,$correocli,$dircli,
        $razonsocial,$dirsocial,$colonia,$ciudad,$estado,$cp,$rfc,$correofac){
        
        $add_suc = $this->db->query("INSERT INTO sucursal(nomsuc, dirsuc, telsuc, cp, estado) 
        VALUES ('$name_suc','$address_suc','$phone_suc','$cp_suc','$state_suc')");

        if($add_suc){
            $consulta=$this->db->query("SELECT MAX(id) as id FROM sucursal WHERE nomsuc='$name_suc'");
            while($filas=$consulta->fetch_assoc()){
                $this->lista[]=$filas;
            }
    
            foreach ($this->lista as $row) {
                $add_rep = $this->db->query("INSERT INTO representante(nomrepre,correorepre,contactorepre,telrepre,
                celularrepre,ine,dirrepre,razonsocialrepre,dirsocialrepre,coloniarepre,ciudadrepre,estadorepre,
                corepre,cp,rfcrepre,correreprefac,idsuc) VALUES ('$contacto','$correocont','$nomcli','
                $telcli','$celular','$ine','$dircli','$razonsocial','$dirsocial','$colonia','$ciudad','$estado','
                $correocli','$cp','$rfc','$correofac',".$row['id'].")");
            }

            echo 'Sucursal y representante guardados exitosamente';
        }
        else{
            echo 'error';
        }
    }

}

?>