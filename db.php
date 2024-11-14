<?php
$servername = "novocomeco.mysql.database.azure.com";
$username = "novocomeco";
$password = "novocomeco#2024";
$dbname = "NovoComeco";
$port = 3306;

$ca_cert = "ca-cert.pem";  // Caminho para o CA Cert
$client_cert = "ca-cert.pem";  // Caminho para o Client Cert
$client_key = "ca-cert.pem";  // Caminho para o Client Key

// Inicializa a conexão com SSL
$mysqli = mysqli_init();
mysqli_ssl_set($mysqli, NULL, NULL, NULL, NULL, NULL);

// Realiza a conexão com o banco de dados
if (!$mysqli->real_connect($servername, $username, $password, $dbname, $port)) {
    die("Falha na conexão: " . $mysqli->connect_error);
}
