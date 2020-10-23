<?php

include "conexion.php";
include "utils.php";

$dbConn =  connect($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST;
	$sql = "INSERT INTO categoria (id_categoria, nombre, capa_bateria, carg_util, capa_espacio) 
            VALUES (NULL, :nombre, NULL, NULL, NULL);";
	$statement = $dbConn->prepare($sql);
	bindAllValues($statement, $input);
    $statement->execute();
    $postId = $dbConn->lastInsertId();
    if($postId)
    {
      $input['id'] = $postId;
      header("HTTP/1.1 200 OK");
      echo json_encode($input);
      exit();
	 }
}