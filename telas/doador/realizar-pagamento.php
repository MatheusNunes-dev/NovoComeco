<?php
session_start();

// Verifica se o usuário está logado, caso contrário, redireciona
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<script>alert('Você precisa estar logado para realizar uma doação. Redirecionando para a página de login...');</script>";
    header("Refresh: 2; url=/telas/usuarios/login.php");
    exit();
}

// Captura o ID da ONG da URL
$ong_id = $_GET['ong'] ?? null; // Agora vamos pegar o ID diretamente dos parâmetros da URL

// Mapeamento de ONGs: ID => Nome da ONG
$ongs = [
    1 => "Mão Amiga",
    2 => "Amigos do Bem",
    3 => "Cultivando a Vida",
    4 => "Coração Solidário",
    5 => "Amigos da Terra",
    6 => "Amor Animal"
];

// Verifica se o ID é válido e obtém o nome da ONG
$ong_selecionada = isset($ongs[$ong_id]) ? $ongs[$ong_id] : "Não especificado";

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
    <link rel="stylesheet" href="../../css/realizar-pagamento-copy-copy.css">
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
                <a href="../../telas/doador/configuracoes.doador.php">
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
                <img id="qrCode" alt="QR Code Aleatório" />
            </div>
            <p>Chave gerada: <span id="chave"></span></p>
            <button onclick="gerarQRCodeComChave()">Gerar QR Code com Chave Aleatória</button>
        </div>
    </div>

    <div class="button-group">
        <button class="btn-voltar" onclick="window.history.back()">Voltar</button>
        <button class="btn-pronto" onclick="window.location.href='confirmacao-pagamento.php'">Pronto</button>
    </div>

    <footer>
        <div class="footer">
            <div class="img-footer-start">
                <img class="boneco-footer" src="../../assets/img-footer.png" alt="Imagem do rodapé">
            </div>
        </div>
    </footer>



    <script>
        // Função para gerar uma chave aleatória
        function gerarChaveAleatoria(tamanho = 16) {
            const caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let chave = '';
            for (let i = 0; i < tamanho; i++) {
                chave += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
            }
            return chave;
        }

        // Função para gerar e exibir o QR code com a chave aleatória
        function gerarQRCodeComChave() {
            const chaveAleatoria = gerarChaveAleatoria();
            const url = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(chaveAleatoria)}`;
            document.getElementById("qrCode").src = url;
            document.getElementById("chave").innerText = chaveAleatoria;
        }

        // Gera um QR code inicial com chave aleatória ao carregar a página
        window.onload = function() {
            gerarQRCodeComChave();
        };
    </script>
</body>

</html>