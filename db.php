<?php
// Conexão com o banco de dados (confira se os dados de conexão estão corretos)
$servername = "novocomeco.mysql.database.azure.com";
$username = "novocomeco";
$password = "novocomeco#2024";
$dbname = "NovoComeco";
$port = 3306;

// Inicializa a conexão com SSL
$mysqli = mysqli_init();

// Configura o SSL (sem caminho de certificado específico)
mysqli_ssl_set($mysqli, NULL, NULL, NULL, NULL, NULL);
?>