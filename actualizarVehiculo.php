<?php

include "conexion.php";
include "utils.php";

header('Content-Type: application/json');

$dbConn =  connect($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	$sql = $dbConn->prepare("UPDATE carro INNER JOIN modelo ON carro.id_modelo = modelo.id_modelo 
    INNER JOIN categoria ON categoria.id_categoria = carro.categoria SET modelo.marca = :marca, modelo.modelo = :modelo, 
    carro.precio = :precio, carro.asientos = :asientos, carro.estado = :estado, carro.fecha_publicacion = :fecha, 
    categoria.tipo = :tipo, categoria.cantidad = :cantidad WHERE carro.id_carro = :id_vehiculo");
    $sql->bindValue(':marca', $_GET['marca']);
    $sql->bindValue(':modelo', $_GET['modelo']);
    $sql->bindValue(':precio', $_GET['precio']);
    $sql->bindValue(':asientos', $_GET['asientos']);
    $sql->bindValue(':estado', $_GET['estado']);
    $sql->bindValue(':fecha', $_GET['fecha']);
    $sql->bindValue(':tipo', $_GET['tipo']);
    $sql->bindValue(':cantidad', $_GET['cantidad']);
    $sql->bindValue(':id_vehiculo', $_GET['id_vehiculo']);
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    
	header("HTTP/1.1 200 OK");
	//$json['categoria'] = $sql->fetchAll();
    //echo json_encode($json);
    $sql1 = $dbConn->prepare("SELECT * FROM carro WHERE id_carro = :id_vehiculo");
    $sql1->bindValue(':id_vehiculo', $_GET['id_vehiculo']);
    $sql1->execute();
	$sql1->setFetchMode(PDO::FETCH_ASSOC);
	header("HTTP/1.1 200 OK");
	echo json_encode($sql1->fetchAll());
	exit();
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");