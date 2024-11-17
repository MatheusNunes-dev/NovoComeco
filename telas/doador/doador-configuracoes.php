<?php
session_start();
require('../../db.php');

function formatarCPF($cpf)
{
    return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $cpf);
}

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['user_tipo'] !== 'doador') {
    header("Location: /telas/usuarios/usu-login.php");
    exit();
}

$user_nome = $_SESSION['user_nome'];
$user_email = $_SESSION['user_email'];
$user_cpf = "";

$user_id = $_SESSION['user_id'];
$sql = "SELECT cpf FROM doador WHERE id_doador = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $doador = $result->fetch_assoc();
    $user_cpf = $doador['cpf'];
}

$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Começo</title>
    <link rel="shortcut icon" href="../../assets/logo.png" type="image/png">
    <link rel="stylesheet" href="../../css/todos-global.css">
    <link rel="stylesheet" href="../../css/todos-configuracoes.css">
    <link rel="stylesheet" href="../../css/configuracoes-doador.css">
</head>

<body>
    <header>
        <nav class="navbar nav-lg-screen" id="navbar">
            <button class="btn-icon-header" onclick="toggleSideBar()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
            <div><img class="img-logo" id="logo" src="../../assets/logo.png" alt="Logo do Novo Começo"></div>
            <div class="nav-links" id="nav-links">
                <ul>
                    <li><button class="btn-icon-header" onclick="toggleSideBar()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg>
                        </button></li>
                    <li class="nav-link"><a href="../../telas/usuarios/usu-index.php">HOME</a></li>
                    <li class="nav-link"><a href="../../telas/usuarios/usu-ongs.php">ONG'S</a></li>
                    <li class="nav-link"><a href="../../telas/usuarios/usu-sobre.php">SOBRE</a></li>
                    <li class="nav-link"><a href="../../telas/usuarios/usu-contato.php">CONTATO</a></li>
                </ul>
            </div>
            <div class="user">
                <a href="doador-configuracoes.php"><img class="img-user" src="../../assets/user.png" alt="Usuário"></a>
            </div>
        </nav>
    </header>
    <main class="container">
        <h1 class="title">Configurações</h1>
        <section class="donation-box">
            <div class="donation-details">
                <p><strong>Usuário:</strong> <?php echo htmlspecialchars($user_nome); ?></p>
                <p><strong>E-mail:</strong> <?php echo htmlspecialchars($user_email); ?></p>
                <p><strong>CPF:</strong> <?php echo htmlspecialchars(formatarCPF($user_cpf)); ?></p>
            </div>
        </section>
        <div class="action-buttons">
            <button class="action-button" onclick="window.location.href='../doador/doador-redefinir-senha.php'">Alterar Senha</button>
            <button class="action-button" onclick="window.location.href='doador-excluir-conta.php'">Excluir Conta</button>
            <button class="action-button" onclick="window.location.href='doador-historico.php'">Histórico Doações</button>
            <button class="action-button" onclick="window.location.href='../../logout.php'">Logout</button>
        </div>
    </main>
    <footer>
        <div class="footer">
            <div class="img-footer-start"><img class="boneco-footer img-footer" src="../../assets/img-footer.png"></div>
            <div class="socias">
                <div class="icons-col-1">
                    <div class="social-footer"><img class="icon-footer" src="../../assets/google.png">
                        <p>novocomeço@gmail.com</p>
                    </div>
                    <div class="social-footer"><img class="icon-footer" src="../../assets/instagram.png">
                        <p>@novocomeço</p>
                    </div>
                </div>
                <div class="icons-col-2">
                    <div class="social-footer"><img class="icon-footer" src="../../assets/whatsapp.png">
                        <p>(41)99997676</p>
                    </div>
                    <div class="social-footer"><img class="icon-footer" src="../../assets/facebook.png">
                        <p>@novocomeco</p>
                    </div>
                </div>
            </div>
            <div class="img-footer-end"><img class="boneco-footer img-footer" src="../../assets/img-footer.png"></div>
        </div>
    </footer>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
    <script src="../../js/header.js"></script>
</body>

</html>