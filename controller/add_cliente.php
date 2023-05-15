<?php
include ("../model/clientes.php");
if(isset($_POST['add_clientes'])){

  $tipopersona=$_POST['persona'];

  if($tipopersona==="fisica"){
    $idsuccli=$_POST['idsuccli'];
   
    $contacto=$_POST['contacto'];
    $correocont=$_POST['correocont'];
    $nomcli=$_POST['nomcli'];
    $telcli=$_POST['telcli'];
    $celular=$_POST['celular'];
    $ine=$_POST['ine'];
    $correocli=$_POST['correocli'];
    $dircli=$_POST['dircli'];
    $razonsocial=$_POST['nomcli'];
    $dirsocial=$_POST['dircli'];
    $colonia="s/n";
     $ciudad="s/c";
    $estado="s/e";
    $cp="s/cp";
    $rfc=$_POST['rfc1'];
    $correofac=$_POST['correocli'];
   $add_unid=new consul();
    $add=$add_unid->add_cliente($idsuccli,$contacto,$correocont,$nomcli,$telcli,$celular,$ine,$correocli,$dircli,$razonsocial,$dirsocial,$colonia,$ciudad,$estado,$cp,$rfc,$correofac);

  }
  if($tipopersona==="moral"){
     
    $idsuccli=$_POST['idsuccli'];
     $contacto=$_POST['contacto'];
    $correocont=$_POST['correocont'];
    $nomcli=$_POST['razonsocial'];
    $telcli=$_POST['correofac'];
    $celular=$_POST['correofac'];
    $ine="s/ine";
    $correocli=$_POST['correocont'];
    $dircli=$_POST['dirsocial'];
    $razonsocial=$_POST['razonsocial'];
    $dirsocial=$_POST['dirsocial'];
    $colonia=$_POST['colonia'];
     $ciudad=$_POST['ciudad'];
    $estado=$_POST['estado'];
    $cp=$_POST['cp'];
    $rfc=$_POST['rfc'];
    $correofac=$_POST['correocont']; 
    $add_unid=new consul();
    $add=$add_unid->add_cliente($idsuccli,$contacto,$correocont,$nomcli,$telcli,$celular,$ine,$correocli,$dircli,$razonsocial,$dirsocial,$colonia,$ciudad,$estado,$cp,$rfc,$correofac);
  }

  
  /*  $idsuccli=$_POST['idsuccli'];
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
    $add_unid=new consul();
    $add=$add_unid->add_cliente($idsuccli,$contacto,$correocont,$nomcli,$telcli,$celular,$ine,$correocli,$dircli,$razonsocial,$dirsocial,$colonia,$ciudad,$estado,$cp,$rfc,$correofac);
*/
}

if(isset($_POST['edit_cliente'])){
    $idcli=$_POST['idcli'];
    $idsuccli=$_POST['idsuccli'];
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
    $add_unid=new consul();
    $add=$add_unid->edit_cliente($idcli,$idsuccli,$contacto,$correocont,$nomcli,$telcli,$celular,$ine,$correocli,$dircli,$razonsocial,$dirsocial,$colonia,$ciudad,$estado,$cp,$rfc,$correofac);
}



?>