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

    public function getRoles(){
        $consulta=$this->db->query("SELECT * FROM rol where id != 1");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
   
    public function getBranchOffice(){
        $consulta=$this->db->query("SELECT id, nomsuc FROM sucursal");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }

    public function getUsers(){
        $consulta=$this->db->query("SELECT * FROM colaboradores c, rol r, sucursal_colaborador sc, sucursal s WHERE c.idrol=r.id and c.id=sc.idcol and sc.idsuc=s.id ORDER BY c.fechacol DESC");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }

    public function add_colaborador($nomcol,$fechacol,$correo,$cuenta,$contra,$idrol,$idsuc)
    {          
        $consulta=$this->db->query("SELECT id FROM colaboradores WHERE correo='$correo'");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }

        if(count($this->lista)==0){
            $alta_colaborador = $this->db->query("INSERT INTO colaboradores(nomcol, fechacol, correo, cuenta, contra, idrol) 
            VALUES ('$nomcol','$fechacol','$correo','$cuenta','$contra','$idrol')");
    
            if($alta_colaborador){
                $consulta=$this->db->query("SELECT MAX(id) as id FROM colaboradores WHERE nomcol='$nomcol'");
                while($filas=$consulta->fetch_assoc()){
                    $this->lista[]=$filas;
                }
        
                foreach ($this->lista as $row) {
                    $alta_colaborador_en_sucursal = $this->db->query("INSERT INTO sucursal_colaborador(idcol, idsuc) 
                    VALUES (".$row['id'].",$idsuc)");
                }
        
                echo 'Usuario '.$cuenta.' agregado exitosamente';
            }
            else{
                echo "Las contraseñas no coinciden. ¡Inténtalo de nuevo!";
            }
        }
        else{
            echo "correo";
        }
    }

    public function nomcol($idc){
        $consulta=$this->db->query("SELECT nomcol, cuenta, idrol FROM colaboradores WHERE id=$idc");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
}