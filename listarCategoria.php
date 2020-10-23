<?php

include "conexion.php";
include "utils.php";

$dbConn =  connect($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	$sql = $dbConn->prepare("SELECT id_categoria, nombre FROM categoria order by id_categoria ASC");
	$sql->execute();
	$sql->setFetchMode(PDO::FETCH_ASSOC);
	header("HTTP/1.1 200 OK");
	$json['categoria'] = $sql->fetchAll();
	echo json_encode($json);
	exit();
}