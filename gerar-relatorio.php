<?php
session_start();
require('../../db.php');
require('../../vendor/autoload.php'); // Biblioteca para PDF (ex: dompdf)

// Verifique se o usuário é administrador
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['user_tipo'] !== 'administrador') {
    header("Location: /telas/usuarios/usu-login.php");
    exit();
}

// Coleta os filtros
$data_inicio = $_POST['data_inicio'] ?? null;
$data_fim = $_POST['data_fim'] ?? null;

$filter_condition = "";
$params = [];

if ($data_inicio && $data_fim) {
    if (strtotime($data_fim) < strtotime($data_inicio)) {
        die("A data final não pode ser anterior à data inicial.");
    }
    $filter_condition .= " WHERE data_emissao BETWEEN ? AND ?";
    $params[] = $data_inicio;
    $params[] = $data_fim;
}

// Consulta ao banco de dados
$query = "
    SELECT 
        ONG.nome AS nome_ong,
        B.valor_transferencia,
        B.data_emissao,
        B.data_vencimento,
        B.status_pagamento
    FROM BOLETO B
    INNER JOIN ONG ON B.id_ong = ONG.id_ong
    $filter_condition
    ORDER BY B.data_emissao DESC
";

$stmt = $mysqli->prepare($query);
if ($stmt && !empty($params)) {
    $types = str_repeat('s', count($params));
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Geração do PDF usando DomPDF
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$html = '<h1>Relatório de Transferências</h1>';
$html .= '<table border="1" cellspacing="0" cellpadding="5">';
$html .= '<tr>
            <th>ONG</th>
            <th>Valor Transferência</th>
            <th>Data Emissão</th>
            <th>Data Vencimento</th>
            <th>Status</th>
          </tr>';

foreach ($data as $row) {
    $html .= "<tr>
                <td>" . htmlspecialchars($row['nome_ong']) . "</td>
                <td>R$ " . number_format($row['valor_transferencia'], 2, ',', '.') . "</td>
                <td>" . date('d/m/Y', strtotime($row['data_emissao'])) . "</td>
                <td>" . date('d/m/Y', strtotime($row['data_vencimento'])) . "</td>
                <td>" . ucfirst($row['status_pagamento']) . "</td>
              </tr>";
}

$html .= '</table>';

// Renderizando o PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("relatorio_transferencias.pdf", ["Attachment" => 1]);

exit();
?>
