<?php 

include "conexion.php";
include "utils.php";

header('Content-Type: application/json');

$dbConn =  connect($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id_vehiculo'])) {
        $sql = $dbConn->prepare("SELECT modelo.marca, modelo.modelo, carro.precio, carro.asientos, 
        carro.estado, carro.fecha_publicacion, categoria.nombre AS categoria, categoria.tipo, categoria.cantidad 
        FROM carro INNER JOIN categoria ON carro.categoria = categoria.id_categoria INNER JOIN modelo 
        ON modelo.id_modelo = carro.id_modelo WHERE id_carro = :id_vehiculo");
        $sql->bindValue(':id_vehiculo', $_GET['id_vehiculo']);
        $sql->execute();
        echo json_encode($sql->fetchAll());
        exit();
    }
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");