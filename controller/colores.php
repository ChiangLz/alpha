<?php
// Utilizaremos conexion PDO PHP
function conexion() {
	//Declaramos el servidor, la BD, el usuario Mysql y Contraseña BD.
    //return new PDO('mysql:host=localhost;dbname=alfadmin_alfa', 'alfadmin_admin', 'AlfaMex2020!', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	return new PDO('mysql:host=localhost;dbname=alfadmin_alfa', 'root', '0000', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

}

$pdo = conexion();
$keyword = '%'.$_POST['palabra'].'%';
$suc=($_POST['suc']);

$sql = "SELECT * FROM cliente WHERE idsucur =".$suc." AND razonsocial LIKE (:keyword) ORDER BY razonsocial ASC LIMIT 0, 7  ";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$lista = $query->fetchAll();
foreach ($lista as $milista) {
	// Colocaremos negrita a los textos
	$pais_nombre = str_replace($_POST['palabra'], '<b>'.$_POST['palabra'].'</b>', $milista['razonsocial']);
	$cadena_devuelta = strtoupper($pais_nombre);
	$cliente_id_name = $milista['id'] . "-" . $cadena_devuelta;
	// Aquì, agregaremos opciones
    #echo '<li onclick="set_item(\''.str_replace("'", "\'", $milista['razonsocial']).'\')">'.$cliente_id_name.'</li>';
	echo '<li onclick="set_item(\''.$cliente_id_name.'\')">'.$cliente_id_name.'</li>';
}
?>