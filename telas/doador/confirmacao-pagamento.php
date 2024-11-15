<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['user_tipo'] !== 'doador') {
    header("Location: /telas/usuarios/login.php");
    exit();
}

// Captura os dados enviados via POST
$id_ong = $_POST['id_ong'] ?? null;
$nome_doador = $_POST['nome_doador'] ?? 'Anônimo';
$valor_total = $_POST['valor_total'] ?? 0;
$valor_taxa = $_POST['valor_taxa'] ?? 0;
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Pagamento</title>
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/confirmacao-pagamento.css">
</head>

<body>
    <main>
        <div class="container">
            <div class="content">
                <h1>Pagamento Confirmado!</h1>
                <p>Obrigado por sua doação, <?php echo htmlspecialchars($nome_doador); ?>.</p>
                <p>ONG Selecionada: <?php echo htmlspecialchars($id_ong); ?></p>
                <p>Valor Total: R$ <?php echo number_format($valor_total, 2, ',', '.'); ?></p>
                <p>Taxa: R$ <?php echo number_format($valor_taxa, 2, ',', '.'); ?></p>
            </div>
            <a href="../telas/index.php" class="btn">Voltar para a página inicial</a>
        </div>
    </main>
</body>

</html>