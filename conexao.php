<?php

$usuario = "root";
$senha = "";
$database = "novocomeco";
$host = "localhost";

$mysqli = new mysqli($host, $usuario, $senha, $database);


if($mysqli->connect_error){
    die("Falha ao conectar ao banco de dados: " . $mysqli->connect_error);
}

ini_set('display_errors', 1);
error_reporting(E_ALL);

?>
