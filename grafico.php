<?php

include('db.php');
$data_inicio = $_GET['data_inicio'] ?? '2023-01-01';
$data_fim = $_GET['data_fim'] ?? date('Y-m-d');

// Query para contar os status_pagamento
$sql = "SELECT status_pagamento, COUNT(*) as total FROM boleto WHERE data_emissao BETWEEN ? AND ? GROUP BY status_pagamento";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $data_inicio, $data_fim);
$stmt->execute();
$result = $stmt->get_result();

// Organiza os dados para o gráfico
$dados = ["realizado" => 0, "pendente" => 0];
while ($row = $result->fetch_assoc()) {
    if ($row['status_pagamento'] == 'realizado') {
        $dados["realizado"] = $row['total'];
    } elseif ($row['status_pagamento'] == 'pendente') {
        $dados["pendente"] = $row['total'];
    }
}

echo json_encode($dados);

$stmt->close();
$conn->close();
?>