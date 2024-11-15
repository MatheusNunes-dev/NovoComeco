<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verifica se o usuário está logado, caso contrário, redireciona
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<script>alert('Você precisa estar logado para realizar uma doação. Redirecionando para a página de login...');</script>";
    header("Refresh: 2; url=../usuarios/index.php");
    exit();
}

// Verifica se o usuário é doador
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'doador') { // Ajuste 'doador' conforme sua lógica de identificação
    echo "<script>alert('Acesso restrito: Somente doadores podem acessar esta página.');</script>";
    header("Refresh: 2; url=../usuarios/index.php");
    exit();
}


// Inclui o arquivo de conexão com o banco de dados
require __DIR__ . '../../../db.php'; // Ajuste o caminho conforme necessário

// Captura a URL da página anterior
$referer = $_SERVER['HTTP_REFERER'] ?? null;

// Inicializa variáveis
$ong_id = null;
$ong_selecionada = "Não especificada";
$chave_pix = "Chave PIX não encontrada";

// Verifica se o referer está definido e extrai o ID da ONG da URL
if ($referer) {
    preg_match('/ong-(\d+)/', $referer, $matches);
    if (isset($matches[1])) {
        $ong_id = (int)$matches[1]; // ID da ONG
    }
}

// Mapeamento de ONGs: ID => Nome da ONG (pode ser substituído por uma busca no banco de dados)
$ongs = [
    1 => "Mão Amiga",
    2 => "Amigos do Bem",
    3 => "Cultivando a Vida",
    4 => "Coração Solidário",
    5 => "Amigos da Terra",
    6 => "Amor Animal"
];

// Verifica se o ID é válido e obtém o nome da ONG
// Verifica se o ID é válido e obtém o nome da ONG
if ($ong_id && isset($ongs[$ong_id])) {
    $ong_selecionada = $ongs[$ong_id];
    error_log("ONG Selecionada: " . $ong_selecionada);

    // Consulta para buscar a chave PIX no banco de dados
    $sql = "SELECT chave_pix FROM ONG WHERE id_ong = ?";
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $ong_id); // "i" para inteiro (id_ong)
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $row = $result->fetch_assoc()) {
            $chave_pix = $row['chave_pix']; // chave_pix é VARCHAR
            error_log("Chave PIX encontrada: " . $chave_pix);
        } else {
            error_log("Nenhum resultado encontrado para o ID: " . $ong_id);
            $chave_pix = "Chave PIX não encontrada para este ID.";
        }
        $stmt->close();
    } else {
        error_log("Erro ao preparar consulta: " . $mysqli->error);
        $chave_pix = "Erro ao preparar consulta.";
    }
} else {
    error_log("ID da ONG inválido ou não encontrado.");
    $chave_pix = "ID da ONG inválido ou não encontrado.";
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
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Começo - Realizar Pagamento</title>
    <link rel="shortcut icon" href="../../assets/logo.png" type="image/png">
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/realizar-pagamento.css">
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
        <div class="button-group">
            <button class="btn-voltar" onclick="window.history.back()">Voltar</button>
            <button class="btn-voltar" onclick="window.location.href='home_doador.php'">Pronto</button>
        </div>
    </div>

    <footer>
        <div class="footer">
            <div class="img-footer-start">
                <img class="boneco-footer" src="../../assets/img-footer.png" alt="Imagem do rodapé">
            </div>
        </div>
    </footer>



    <script>
    </script>
</body>

</html>