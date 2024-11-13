<?php
$servername = "novocomeco.mysql.database.azure.com";
$username = "novocomeco";
$password = "novocomeco#2024";
$dbname = "NovoComeco";
$port = 3306;

// Inicializa a conexão com SSL
$mysqli = mysqli_init();
mysqli_ssl_set($mysqli, NULL, NULL, NULL, NULL, NULL);

// Realiza a conexão com o banco de dados
if (!$mysqli->real_connect($servername, $username, $password, $dbname, $port)) {
    die("Falha na conexão: " . $mysqli->connect_error);
}




?>
