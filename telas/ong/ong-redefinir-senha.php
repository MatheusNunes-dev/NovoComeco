<?php
session_start();

// Verifica se o usuário está logado como ONG
$isLoggedIn = isset($_SESSION['user_id']);
$tipoUsuario = $_SESSION['user_tipo'] ?? null;
$email = $_SESSION['user_email'] ?? null;

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $tipoUsuario !== 'ong') {
    header("Location: /telas/usuarios/login.php");
    exit();
}

// Inclui a conexão com o banco de dados
include_once('../../db.php');

// Habilita exibição de erros para depuração
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nova_senha = trim($_POST['nova_senha']);
    $confirmar_senha = trim($_POST['confirmar_senha']);

    if (empty($nova_senha) || empty($confirmar_senha)) {
        $error_message = "Todos os campos são obrigatórios.";
    } elseif ($nova_senha !== $confirmar_senha) {
        $error_message = "As senhas não coincidem.";
    } else {
        // Armazena diretamente a nova senha sem criptografia
        $senha = $nova_senha;

        // Atualiza a senha no banco de dados para a ONG logada
        $sql = "UPDATE ONG SET senha = ? WHERE email = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("ss", $senha, $email);

            if ($stmt->execute()) {
                // Destruir sessão após a alteração da senha
                session_unset(); // Remove todas as variáveis da sessão
                session_destroy(); // Destrói a sessão atual

                // Redireciona para a página de login
                header("Location: ../usuarios/login.php");
                exit();
            } else {
                $error_message = "Erro ao atualizar a senha: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $error_message = "Erro ao preparar a consulta: " . $mysqli->error;
        }
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
                <a href="configuracoes-doador.php">
                    <img class="img-user" src="../../assets/user.png" alt="Usuário">
                </a>
            </div>
        </nav>
    </header>

    <main>
        <div class="title">
            <h1>Redefinir Senha</h1>
            <?php
            if (!empty($error_message)) {
                echo "<p style='color: red;'>$error_message</p>";
            }
            if (!empty($success_message)) {
                echo "<p style='color: green;'>$success_message</p>";
            }
            ?>
        </div>
        <section class="password-change">
            <form id="password-form" action="" method="POST" aria-labelledby="password-change-section">
                <div class="input-group">
                    <label for="nova-senha">Nova senha</label>
                    <input type="password" id="nova-senha" name="nova_senha" required>
                </div>
                <div class="input-group">
                    <label for="confirme-nova-senha">Confirme sua nova senha</label>
                    <input type="password" id="confirme-nova-senha" name="confirmar_senha" required>
                </div>
                <div class="action-buttons">
                    <button type="button" class="action-button" onclick="cancelarAlteracao()">Cancelar</button>
                    <button type="submit" class="confirm-button">Confirmar</button>
                </div>
            </form>
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

        setTimeout(() => {
            messageContainer.innerHTML = '';
        }, 5000); // Remove a mensagem após 5 segundos
    </script>
</body>

</html>