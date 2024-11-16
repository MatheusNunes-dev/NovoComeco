<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verifica se o usuário está logado e redireciona se não estiver
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['user_tipo'] !== 'doador') {
    header("Location: /telas/usuarios/login.php");
    exit();
}

// Inclui o arquivo de conexão com o banco de dados
require __DIR__ . '../../../db.php'; // Ajuste o caminho conforme necessário

// Captura a URL da página anterior (referer)
$referer = $_SERVER['HTTP_REFERER'] ?? null;

// Inicializa variáveis
$ong_id = null;
$ong_selecionada = "Não especificada";
$chave_pix = "Chave PIX não encontrada";

// Captura o ID da ONG da URL (query string)
if (isset($_GET['ong'])) {
    $ong_id = (int)$_GET['ong']; // Captura o ID da ONG diretamente da URL
}

// Verifica se o ID da ONG é válido
if ($ong_id) {
    // Consulta para buscar o nome e a chave PIX da ONG no banco de dados
    $sql = "SELECT id_ong, nome, chave_pix FROM ONG WHERE id_ong = ?";
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $ong_id); // "i" para inteiro (id_ong)
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se a ONG foi encontrada
        if ($result && $row = $result->fetch_assoc()) {
            $ong_selecionada = $row['nome']; // Nome da ONG
            $chave_pix = $row['chave_pix']; // Chave PIX da ONG
            $id_ong = $row['id_ong']; // ID da ONG
        } else {
            echo "ONG não encontrada para id_ong: $ong_id"; // Depuração
        }
        $stmt->close();
    } else {
        echo "Erro na consulta: " . $stmt->error; // Depuração
    }
} else {
    echo "ID da ONG não encontrado."; // Depuração
}

// Captura outros parâmetros da URL
$valor = $_GET['valor'] ?? 0;
$taxa = $_GET['taxa'] ?? 0;
$nome_doador = $_SESSION['user_nome'] ?? ($_GET['doador'] ?? 'Anônimo');

// Verifica se os valores são válidos
if ($valor <= 0 || $taxa < 0) {
    echo "<script>alert('Valores de doação ou taxa inválidos.');</script>";
    header("Refresh: 2; url=/telas/usuarios/pagina-quero-doar.php");
    exit();
}

if (isset($_POST['finalizar_doacao'])) {
    // Define o fuso horário para Brasília
    date_default_timezone_set('America/Sao_Paulo');

    // Captura a data e hora atual no horário de Brasília
    $data_hora = date('Y-m-d H:i:s'); // Formato: '2024-11-15 13:45:00'

    // Define os parâmetros da doação
    $id_ong = $ong_id; // ID da ONG selecionada
    $id_doador = $_SESSION['user_id']; // ID do doador, capturado da sessão
    $valor_total = $valor;
    $valor_taxa = $taxa;
    $status = 'realizado'; // Inicialmente marcada como pendente

    // Consulta SQL para inserir os dados na tabela DOACAO
    $sql = "INSERT INTO DOACAO (id_ong, id_doador, valor_total, valor_taxa, data_hora, status) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("iiddss", $id_ong, $id_doador, $valor_total, $valor_taxa, $data_hora, $status);
        if ($stmt->execute()) {
            echo "<script>alert('Doação registrada com sucesso!');</script>";
            header("Location: home_doador.php"); // Redireciona após a inserção
            exit();
        } else {
            echo "<script>alert('Erro ao registrar a doação.');</script>";
            // Verifique o erro
            echo "Erro: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "<script>alert('Erro na preparação da consulta.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Começo - Realizar Pagamento</title>
    <link rel="shortcut icon" href="../../assets/logo.png" type="image/png">
    <link rel="stylesheet" href="../../css/todos-global.css">
    <link rel="stylesheet" href="../../css/doador-realizar-pagamento.css">
</head>

<body>
    <header>
        <nav class="navbar nav-lg-screen" id="navbar">
            <button class="btn-icon-header" onclick="toggleSideBar()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
            <div>
                <img class="img-logo" id="logo" src="../../assets/logo.png" alt="Logo">
            </div>
            <div class="nav-links" id="nav-links">
                <ul>
                    <li><button class="btn-icon-header" onclick="toggleSideBar()">X</button></li>
                    <li class="nav-link"><a href="../../telas/usuarios/index.php">HOME</a></li>
                    <li class="nav-link"><a href="../../telas/usuarios/pagina-quero-doar.php">ONG'S</a></li>
                    <li class="nav-link"><a href="../../telas/usuarios/sobre.php">SOBRE</a></li>
                    <li class="nav-link"><a href="../../telas/usuarios/contato.php">CONTATO</a></li>
                </ul>
            </div>
            <div class="user">
                <a href="configuracoes-doador.php">
                    <img class="img-user" src="../../assets/user.png" alt="Usuário">
                </a>
            </div>
        </nav>
    </header>

    <div class="main-container">
        <!-- Seção de Resumo da Doação -->
        <div class="summary-section">
            <h2>Resumo da Doação</h2>
            <div class="button-container">
                <p><span class="fake-button"><strong>ONG Selecionada:</strong> <?php echo $ong_selecionada; ?></span></p>
                <p><span class="fake-button"><strong>Nome do Doador:</strong> <?php echo htmlspecialchars($nome_doador); ?></span></p>
                <p><span class="fake-button"><strong>Valor da Doação:</strong> R$ <?php echo number_format($valor, 2, ',', '.'); ?></span></p>
                <p><span class="fake-button"><strong>Taxa:</strong> R$ <?php echo number_format($taxa, 2, ',', '.'); ?></span></p>
            </div>
        </div>

        <!-- Caixa PIX -->
        <div class="pix-box">
            <div class="pix-image">
                <img src="../../assets/pix.png" alt="PIX" style="width: 100%; height: auto; object-fit: contain;">
            </div>
            <p>Chave da ONG: <span id="chave"><?= htmlspecialchars($chave_pix); ?></span></p>
        </div>

    </div>

    <div class="button-group">
        <button class="btn-voltar" onclick="window.history.back()">Voltar</button>
        <form method="post">
            <button type="submit" name="finalizar_doacao" class="btn-voltar">Pronto</button>
        </form>
    </div>

    <footer>
        <div class="footer">
            <div class="img-footer-start">
                <img class="boneco-footer" src="../../assets/img-footer.png" alt="Imagem