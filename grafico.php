<?php
// Exibir erros para depuração
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Incluir a conexão com o banco de dados
include('db.php'); // ou o caminho correto para o seu db.php

// Verificar se a conexão foi estabelecida corretamente
if (!$mysqli) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

// Obter os parâmetros de data
$data_inicio = $_GET['data_inicio']; // Exemplo: 2024-10-16
$data_fim = $_GET['data_fim']; // Exemplo: 2024-11-15

// Ajustar as datas para incluir hora
$data_inicio .= " 00:00:00"; // Definir como 00:00:00
$data_fim .= " 23:59:59"; // Definir como 23:59:59

// Preparar a consulta SQL
$sql = "SELECT ONG.nome, SUM(DOACAO.valor_total) AS valor_total
        FROM DOACAO
        JOIN ONG ON DOACAO.id_ong = ONG.id_ong
        WHERE DOACAO.data_hora BETWEEN ? AND ?
        GROUP BY ONG.nome";

$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    die("Erro ao preparar a consulta: " . $mysqli->error);
}

// Bind dos parâmetros
$stmt->bind_param('ss', $data_inicio, $data_fim);

// Executar a consulta
if (!$stmt->execute()) {
    die("Erro ao executar a consulta: " . $stmt->error);
}

// Obter os resultados
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $dados = [];
    while ($row = $result->fetch_assoc()) {
        $dados[] = $row;
    }
    // Retornar os dados como JSON
    echo json_encode($dados);
} else {
    // Caso não haja resultados
    echo json_encode([]);
}
