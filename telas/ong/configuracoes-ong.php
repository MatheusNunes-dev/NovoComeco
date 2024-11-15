<?php
session_start();

// Verificar se o usuário é uma ONG
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['user_tipo'] !== 'ong') {
    header("Location: /telas/usuarios/login.php");
    exit();
}

// Incluir conexão com o banco de dados
include('../../db.php');

// Obter o ID da ONG logada
$user_id = $_SESSION['user_id'];

// Buscar informações da ONG no banco de dados
$nome_ong = $email_ong = $cnpj_ong = '';
try {
    $sql = "SELECT nome, email, cnpj FROM ONG WHERE id_ong = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $ong = $result->fetch_assoc();
        $nome_ong = $ong['nome'];
        $email_ong = $ong['email'];
        $cnpj_ong = $ong['cnpj'];
    } else {
        echo "<script>
            alert('Não foi possível carregar os dados da ONG. Por favor, tente novamente.');
            window.location.href = '/telas/usuarios/login.php';
        </script>";
        exit();
    }
} catch (Exception $e) {
    echo "<script>
        alert('Erro ao buscar informações da ONG: " . addslashes($e->getMessage()) . "');
        window.location.href = '/telas/usuarios/login.php';
    </script>";
    exit();
} finally {
    if (isset($stmt)) $stmt->close();
    if (isset($mysqli)) $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Começo - Configurações</title>
    <link rel="shortcut icon" href="../../assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/configuracoes.css">
    <link rel="stylesheet" href="../../css/configuracoes-ong.css">
</head>

<body>
    <!-- Cabeçalho -->
    <header>
        <nav class="navbar nav-lg-screen" id="navbar">
            <button class="btn-icon-header" onclick="toggleSideBar()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
            <div>
                <img class="img-logo" id="logo" src="../../assets/logo.png" alt="Logo da Novo Começo">
            </div>
            <div class="nav-links" id="nav-links">
                <ul>
                    <li>
                        <button class="btn-icon-header" onclick="toggleSideBar()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg>
                        </button>
                    </li>
                    <li class="nav-link"><a href="../../telas/usuarios/index.php">HOME</a></li>
                    <li class="nav-link"><a href="../../telas/usuarios/pagina-quero-doar.php">ONG'S</a></li>
                    <li class="nav-link"><a href="../../telas/usuarios/sobre.php">SOBRE</a></li>
                    <li class="nav-link"><a href="../../telas/usuarios/contato.php">CONTATO</a></li>
                </ul>
            </div>
            <div class="user">
                <a href="../../telas/ong/configuracoes-ong.php">
                    <img class="img-user" src="../../assets/user.png" alt="Usuário">
                </a>
            </div>
        </nav>
    </header>

    <!-- Conteúdo Principal -->
    <main class="container">
        <h1 class="title">Configurações</h1>

        <!-- Detalhes do Usuário -->
        <section class="donation-box">
            <div class="circle">
                <p>FOTO</p>
            </div>
            <div class="donation-details">
                <p><strong>ONG:</strong> <?= htmlspecialchars($nome_ong) ?></p>
                <p><strong>E-mail:</strong> <?= htmlspecialchars($email_ong) ?></p>
                <p><strong>CNPJ:</strong> <?= htmlspecialchars($cnpj_ong) ?></p>
            </div>
        </section>

        <!-- Ações do Usuário -->
        <div class="action-buttons">
            <button class="action-button" onclick="window.location.href='../usuarios/redefinicao-senha.php'">Redefinir Senha</button>
            <button class="action-button" onclick="window.location.href='desvincular-ong.php'">Desvincular ONG</button>
            <button class="action-button" onclick="window.location.href='../../logout.php'">Logout</button>
        </div>
    </main>

    <!-- Rodapé -->
    <footer>
        <div class="footer">
            <div class="img-footer-start">
                <img class="boneco-footer img-footer" src="../../assets/img-footer.png" alt="Boneco do rodapé">
            </div>
            <div class="socias">
                <div class="icons-col-1">
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/google.png" alt="Google">
                        <p>novocomeço@gmail.com</p>
                    </div>
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/instagram.png" alt="Instagram">
                        <p>@novocomeço</p>
                    </div>
                </div>
                <div class="icons-col-2">
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/whatsapp.png" alt="Whatsapp">
                        <p>(41) 99997-6767</p>
                    </div>
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/facebook.png" alt="Facebook">
                        <p>@novocomeco</p>
                    </div>
                </div>
            </div>
            <div class="img-footer-end">
                <img class="boneco-footer img-footer" src="../../assets/img-footer.png" alt="Boneco do rodapé">
            </div>
        </div>
    </footer>

    <script src="../../js/header.js"></script>
</body>

</html>