<?php
session_start();

// Verifica se o usuário está logado, caso contrário, redireciona
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<script>alert('Você precisa estar logado para redefinir a senha. Redirecionando para a página de login...');</script>";
    header("Refresh: 2; url=/telas/usuarios/login.php");
    exit();
}

include_once('../../db.php'); // Certifique-se de que o caminho está correto

if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
} else {
    echo "Conexão bem-sucedida com o banco de dados.";
}


// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $email = $_SESSION['email']; // Email do usuário logado

    // Verifica se as senhas coincidem
    if ($nova_senha !== $confirmar_senha) {
        echo "<script>alert('As senhas não coincidem.');</script>";
        exit();
    }

    // Hash seguro da nova senha
    $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

    // Atualiza a senha no banco de dados
    $sql = "UPDATE DOADOR SET senha = ? WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $senha_hash, $email);

    if ($stmt->execute()) {
        echo "<script>alert('Senha redefinida com sucesso!');</script>";
        header("Refresh: 2; url=/telas/usuarios/dashboard.php");
        exit();
    } else {
        echo "<script>alert('Erro ao atualizar a senha. Tente novamente.');</script>";
        exit();
    }
}
?>




<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha - Novo Começo</title>
    <link rel="shortcut icon" href="../../assets/logo.png" type="Alegrinho">
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/redefinicao-senha-copy.css">
</head>

<body>
    <header>
        <nav class="navbar nav-lg-screen" id="navbar">
            <button class="btn-icon-header" onclick="toggleSideBar()" aria-label="Abrir menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
            <div>
                <img class="img-logo" id="logo" src="../../assets/logo.png" alt="Logo do Novo Começo">
            </div>
            <div class="nav-links" id="nav-links">
                <ul>
                    <li>
                        <button class="btn-icon-header" onclick="toggleSideBar()" aria-label="Fechar menu">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-x" viewBox="0 0 16 16">
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
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
                <a href="../../telas/usuarios/login.php">
                    <img class="img-user" src="../../assets/user.png" alt="Usuário">
                </a>
            </div>
        </nav>
    </header>

    <main>
        <div class="title">
            <h1>Alterar Senha</h1>
        </div>
        <section class="password-change">
            <form id="password-form" action="../doador/redefinicao-senha.php" method="POST" aria-labelledby="password-change-section">
                <div class="input-group">
                    <label for="nova-senha">Nova senha</label>
                    <input type="password" id="nova-senha" name="nova-senha" required aria-required="true">
                </div>
                <div class="input-group">
                    <label for="confirme-nova-senha">Confirme sua nova senha</label>
                    <input type="password" id="confirme-nova-senha" name="confirme-nova-senha" required aria-required="true">
                </div>
                <div class="action-buttons">
                    <button type="button" class="action-button" onclick="cancelarAlteracao()">Cancelar</button>
                    <button type="submit" class="confirm-button">Confirmar</button>
                </div>
            </form>
            <div id="message-container"></div> <!-- Para exibir a mensagem de erro ou sucesso -->
        </section>
    </main>

    <footer>
        <div class="footer">
            <div class="img-footer-start">
                <img class="boneco-footer" class="img-footer" src="../../assets/img-footer.png" alt="Personagem do rodapé">
            </div>
            <div class="socias">
                <div class="icons-col-1">
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/google.png" alt="Ícone Google">
                        <p>novocomeço@gmail.com</p>
                    </div>
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/instagram.png" alt="Ícone Instagram">
                        <p>@novocomeço</p>
                    </div>
                </div>
                <div class="icons-col-2">
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/whatsapp.png" alt="Ícone WhatsApp">
                        <p>(41)99997676</p>
                    </div>
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/facebook.png" alt="Ícone Facebook">
                        <p>@novocomeco</p>
                    </div>
                </div>
            </div>
            <div class="img-footer-end">
                <img class="boneco-footer" class="img-footer" src="../../assets/img-footer.png" alt="Personagem do rodapé">
            </div>
        </div>
    </footer>

    <script src="../../js/header.js"></script>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');

        // Função para validar a senha
        document.getElementById('password-form').onsubmit = function(event) {
            var novaSenha = document.getElementById('nova-senha').value;
            var confirmeSenha = document.getElementById('confirme-nova-senha').value;
            var messageContainer = document.getElementById('message-container');

            // Limpar mensagens anteriores
            messageContainer.innerHTML = '';

            if (novaSenha !== confirmeSenha) {
                // Exibir mensagem de erro
                messageContainer.innerHTML = '<div class="error-message">As senhas não coincidem. Por favor, tente novamente.</div>';
                event.preventDefault(); // Impede o envio do formulário
            } else {
                // Exibir mensagem de sucesso
                messageContainer.innerHTML = '<div class="success-message">Senhas coincidem. A alteração será feita!</div>';
            }
        }

        // Função para cancelar
        function cancelarAlteracao() {
            window.location.href = "../../telas/usuarios/index.php"; // Redireciona para a página inicial ou outra de sua escolha
        }
    </script>
</body>

</html>