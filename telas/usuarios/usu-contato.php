<?php
session_start();
require('../../db.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$successMessage = $errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $mensagem = trim($_POST['mensagem']);

    if (empty($nome)) {
        $errorMessage = "O campo Nome está vazio.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "O e-mail é inválido.";
    } elseif (empty($mensagem)) {
        $errorMessage = "O campo Mensagem está vazio.";
    } else {
        $sql = "INSERT INTO contato (nome, email, mensagem, status) VALUES (?, ?, ?, 'nao_lido')";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $nome, $email, $mensagem);

            if ($stmt->execute()) {
                $successMessage = "Mensagem enviada com sucesso!";
            } else {
                $errorMessage = "Erro ao executar a consulta. Tente novamente.";
            }
            $stmt->close();
        } else {
            $errorMessage = "Erro ao preparar a consulta. Tente novamente.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/logo.png" type="image/png">
    <link rel="stylesheet" href="../../css/todos-global.css">
    <link rel="stylesheet" href="../../css/usuario-contato.css">
    <title>Novo Começo</title>
</head>

<body>
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
                <img class="img-logo" id="logo" src="../../assets/logo.png" alt="Logo">
            </div>
            <div class="nav-links" id="nav-links">
                <ul>
                    <li class="nav-link"><a href="../../telas/usuarios/usu-index.php">HOME</a></li>
                    <li class="nav-link"><a href="../../telas/usuarios/usu-ongs.php">ONG'S</a></li>
                    <li class="nav-link"><a href="../../telas/usuarios/usu-sobre.php">SOBRE</a></li>
                    <li class="nav-link"><a href="../../telas/usuarios/usu-contato.php">CONTATO</a></li>
                </ul>
            </div>
            <div class="user">
                <a href="usu-login.php"><img class="img-user" src="../../assets/user.png" alt="Usuário"></a>
            </div>
        </nav>
    </header>
    <main>
        <section>
            <?php if (!empty($successMessage)): ?>
                <p class="success-message"><?= htmlspecialchars($successMessage); ?></p>
            <?php endif; ?>
            <?php if (!empty($errorMessage)): ?>
                <p class="error-message"><?= htmlspecialchars($errorMessage); ?></p>
            <?php endif; ?>

            <form class="form" method="post">
                <div class="title-form">
                    <h1 class="title-form-text">ENTRE EM CONTATO</h1>
                </div>
                <div>
                    <input class="input" type="text" name="nome" placeholder="Nome:" id="nome" required>
                </div>
                <div>
                    <input class="input" type="email" name="email" placeholder="E-mail:" id="email" required>
                </div>
                <div>
                    <textarea class="text-area" placeholder="Mensagem:" name="mensagem" id="mensagem" required></textarea>
                </div>
                <button type="submit" class="btn-submit">Enviar</button>
            </form>
        </section>
    </main>
</body>

</html>