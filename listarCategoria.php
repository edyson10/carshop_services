<?php

include "conexion.php";
include "utils.php";

header('Content-Type: application/json');

$dbConn =  connect($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	$sql = $dbConn->prepare("SELECT id_categoria, nombre FROM categoria order by id_categoria ASC");
	$sql->execute();
	$sql->setFetchMode(PDO::FETCH_ASSOC);
	header("HTTP/1.1 200 OK");
	//$json['categoria'] = $sql->fetchAll();
	//echo json_encode($json);
	echo json_encode($sql->fetchAll());
	exit();
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
