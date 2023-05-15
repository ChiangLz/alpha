<?php
include 'conexion.php';
class consul
{
    private $db;
    private $lista;
    private $prov;
    private $tbl;

    public function __construct()
    {
        $this->db = conexion::con();
        $this->lista = array();
    }
    public function login($usuario, $contrasena)
    {
        $consulta = $this->db->query("SELECT colaboradores.id as idc,colaboradores.nomcol,colaboradores.idrol as idr,sucursal.id as ids, rol.tipo_rol from colaboradores INNER JOIN sucursal_colaborador ON colaboradores.id=sucursal_colaborador.idcol INNER JOIN sucursal ON sucursal_colaborador.idsuc=sucursal.id INNER JOIN rol ON rol.id=colaboradores.idrol WHERE colaboradores.cuenta='$usuario' AND colaboradores.contra='$contrasena'");
        while ($filas = $consulta->fetch_assoc()) {
            $this->lista[] = $filas;
        }
        return $this->lista;
    }
   
}