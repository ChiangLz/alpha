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

    public function add_cliente($idsuccli,$contacto,$correocont,$nomcli,$telcli,$celular,$ine,$correocli,$dircli,$razonsocial,$dirsocial,$colonia,$ciudad,$estado,$cp,$rfc,$correofac)
    {
                                                              
        $alta_unidades = $this->db->query("INSERT INTO cliente(id, contacto, correocont, nomcli, telcli, celular, ine, correocli, dircli, razonsocial, dirsocial, colonia, ciudad, estado, cp, rfc, correofac, idsucur) 
        VALUES (null,'$contacto','$correocont','$nomcli','$telcli','$celular','$ine','$correocli','$dircli','$razonsocial','$dirsocial','$colonia','$ciudad','$estado','$cp','$rfc','$correofac',$idsuccli)");
        echo 'Cliente agregado exitosamente';
    }
    

    public function cliente_sucursal($ids){
        $consulta=$this->db->query("SELECT cliente.id as idc, cliente.nomcli, cliente.rfc, sucursal.nomsuc FROM cliente INNER JOIN sucursal ON cliente.idsucur=sucursal.id WHERE idsucur=$ids ORDER BY `cliente`.`razonsocial`  ASC");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function cliente_sucursaladm(){
        $consulta=$this->db->query("SELECT cliente.id as idc, cliente.nomcli, cliente.rfc, sucursal.nomsuc FROM cliente INNER JOIN sucursal ON cliente.idsucur=sucursal.id");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function clientes($ids){
        $consulta=$this->db->query("SELECT * FROM cliente WHERE id=$ids");
        while($filas=$consulta->fetch_assoc()){
            $this->lista[]=$filas;
        }
        return $this->lista;
    }
    public function edit_cliente($idcli,$idsuccli,$contacto,$correocont,$nomcli,$telcli,$celular,$ine,$correocli,$dircli,$razonsocial,$dirsocial,
    $colonia,$ciudad,$estado,$cp,$rfc,$correofac)
    {
        $alta_unidades = $this->db->query("UPDATE cliente SET id=$idcli,contacto='$contacto',correocont='$correocont',nomcli='$nomcli',
        telcli='$telcli',celular='$celular',ine='$ine',correocli='$correocli',dircli='$dircli',razonsocial='$razonsocial',
        dirsocial='$dirsocial',colonia='$colonia',ciudad='$ciudad',estado='$estado',cp='$cp',rfc='$rfc',correofac='$correofac',idsucur=$idsuccli WHERE id=$idcli");
        echo '<script type="text/javascript">
       alert("Cliente actualizado exitosamente");
       window.location.href="../views/clientes.php";
       </script>';
    }



}