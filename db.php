<?php
$servername = "localhost";  // ou o endereço do seu servidor MySQL
$username = "root";         // nome de usuário do MySQL
$password = "";             // senha do MySQL
$dbname = "novocomeco";     // nome do banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
