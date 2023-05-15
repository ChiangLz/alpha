<?php
include ("../model/representante.php");

if(isset($_POST['add_representante'])){
    $idrepre=$_POST['idrepre'];
    $idsuc=$_POST['idsucrep'];
    $contacto=$_POST['contacto'];
    $correocont=$_POST['correocont'];
    $nomcli=$_POST['nomcli'];
    $telcli=$_POST['telcli'];
    
    $celular=$_POST['celular'];
    $ine=$_POST['ine'];
    $correocli=$_POST['correocli'];
    $dircli=$_POST['dircli'];
    $razonsocial=$_POST['razonsocial'];
    $dirsocial=$_POST['dirsocial'];
    $colonia=$_POST['colonia'];
     $ciudad=$_POST['ciudad'];
    $estado=$_POST['estado'];
    $cp=$_POST['cp'];
    $rfc=$_POST['rfc'];
    $correofac=$_POST['correofac'];
    $add_repre=new consul();
    $add=$add_repre->edit_representante($idrepre,$idsuc,$contacto,$correocont,$nomcli,$telcli,$celular,$ine,$correocli,$dircli,$razonsocial,$dirsocial,
    $colonia,$ciudad,$estado,$cp,$rfc,$correofac);

}


?>