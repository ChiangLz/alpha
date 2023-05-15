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

    public function baja_unidades($valorsuc,$valordescrip,$valormoney, $dia, $idsuc)
    {
        $alta_unidades = $this->db->query("INSERT INTO bajas(idbaja, descripcion, valor, baja, idunidad, suc) 
        VALUES (null,'$valordescrip','$valormoney','$dia',$valorsuc, $idsuc)");
       /*echo '<script type="text/javascript">
       alert("Unidad agregado exitosamente");
       window.location.href="../views/unidades.php";
       </script>';*/
    }

    
    public function edit_unidades($valorsuc,$nomuni,$serie,$fecha_alta,$marca,$modelo,$placas,$caja,$refrigeracion,$capacidadmac,$costo,
    $descripcion,$foto,$tipo,$idsuc,$disposicion,$ultimaactividad){
        $edit_unid = $this->db->query("UPDATE unidades SET noserie=$valorsuc, nomuni='$nomuni',
        serie='$serie',fecha_alta='$fecha_alta',marca='$marca',modelo='$modelo',placas='$placas',caja='$caja',
        refrigeracion='$refrigeracion',capasidad_max='$capacidadmac',costo_adquisicion='$costo',descripuni=' $descripcion',
        foto='$foto',iddispo=$disposicion,tipo='$tipo',idsuc=$idsuc, ultimaactividad='$ultimaactividad' WHERE noserie=$valorsuc");
        
        echo 'Unidad se dio de baja';
    }



}