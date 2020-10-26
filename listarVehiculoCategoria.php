<?php

include "conexion.php";
include "utils.php";

header('Content-Type: application/json');

$dbConn =  connect($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['categoria'])) {
        $sql = $dbConn->prepare("SELECT carro.id_carro, modelo.marca, modelo.modelo, carro.precio, carro.asientos, 
        carro.estado, carro.fecha_publicacion, categoria.nombre AS categoria, categoria.tipo, categoria.cantidad 
        FROM carro INNER JOIN categoria ON carro.categoria = categoria.id_categoria INNER JOIN modelo 
        ON modelo.id_modelo = carro.id_modelo WHERE categoria = :categoria");
        $sql->bindValue(':categoria', $_GET['categoria']);
        $sql->execute();
        echo json_encode($sql->fetchAll());
        exit();
    }
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");