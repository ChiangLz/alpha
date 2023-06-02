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

} // Change name of POST, it is update.

if(isset($_POST['type']) && $_POST['type']=='add_sucursal'){
    $name_suc=$_POST['name_suc'];
    $phone_suc=$_POST['phone_suc'];
    $cp_suc=$_POST['cp_suc'];
    $state_suc=$_POST['state_suc'];
    $address_suc=$_POST['address_suc'];

    $contacto=$_POST['contact_rep'];
    $correocont=$_POST['email_contact_rep'];
    $nomcli=$_POST['name_rep'];
    $telcli=$_POST['phone_rep'];
    $celular=$_POST['cel_rep'];

    $ine=$_POST['ine_rep'];
    $correocli=$_POST['email_rep'];
    $dircli=$_POST['address_rep'];
    $razonsocial=$_POST['reason_social_rep'];
    $dirsocial=$_POST['address_social_rep'];

    $colonia=$_POST['suburb_rep'];
    $ciudad=$_POST['country_rep'];
    $estado=$_POST['state_rep'];
    $cp=$_POST['cp_rep'];
    $rfc=$_POST['rfc_rep'];
    $correofac=$_POST['email_fac_rep'];

    $add=new consul();
    $result=$add->add_sucursal($name_suc,$phone_suc,$cp_suc,$state_suc,$address_suc,
    $contacto,$correocont,$nomcli,$telcli,$celular,$ine,$correocli,$dircli,$razonsocial,$dirsocial,
    $colonia,$ciudad,$estado,$cp,$rfc,$correofac);

    echo $result;
}

?>