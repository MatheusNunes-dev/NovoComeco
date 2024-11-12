<?php
session_start();
include('../../db.php');

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha
    $telefone = $_POST['telefone'];
    $end_rua = $_POST['end_rua'];
    $end_numero = $_POST['end_numero'];
    $end_bairro = $_POST['end_bairro'];
    $end_cidade = $_POST['end_cidade'];
    $end_estado = $_POST['end_estado'];
    $end_completento = $_POST['end_completento'];
    $cpf = $_POST['cpf'];

    // Insere os dados no banco
    $sql = "INSERT INTO ADMINISTRADOR (nome, email, senha, telefone, end_rua, end_numero, end_bairro, end_cidade, end_estado, end_completento, cpf)
            VALUES ('$nome', '$email', '$senha', '$telefone', '$end_rua', '$end_numero', '$end_bairro', '$end_cidade', '$end_estado', '$end_completento', '$cpf')";

    if ($conn->query($sql) === TRUE) {
        // O cadastro foi bem-sucedido, agora vamos fazer login automaticamente

        // Buscar o administrador recém-cadastrado
        $sql = "SELECT * FROM ADMINISTRADOR WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verifica se a senha bate com a armazenada
            if (password_verify($_POST['senha'], $row['senha'])) {
                // Salva as informações do administrador na sessão
                $_SESSION['admin_id'] = $row['id_administrador'];
                $_SESSION['admin_nome'] = $row['nome'];
                $_SESSION['admin_email'] = $row['email'];

                // Redireciona para o painel do administrador
                header("Location: ../administrador/configuracoes-administrador.php");
                exit();
            } else {
                echo "Erro ao verificar a senha!";
            }
        }
    } else {
        echo "Erro ao cadastrar o administrador: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta - Novo Começo</title>
    <link rel="shortcut icon" href="../../assets/logo.png" type="Alegrinho">
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/cadastrar.css">
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
                    <li>
                        <button class="btn-icon-header" onclick="toggleSideBar()">
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
    <div class="container">
        <h1 class="main-title">Criar Conta</h1>

        <section class="register-section">
            <h2 class="section-title">Administrador</h2>
            <p>Crie sua conta e ajude o próximo!</p>


            <form action="../../register.php" method="POST">
                <!-- Informações Pessoais -->
                <div class="input-group">
                    <input type="text" id="codigo" name="codigo" placeholder="Código de Administrador" required>
                </div>
                <div class="input-group">
                    <input type="text" id="name" name="name" placeholder="Nome Completo" required>
                </div>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="E-mail" required>
                </div>
                <div class="input-group">
                    <input type="tel" id="phone" name="phone" placeholder="Telefone (XX-XXXXXXXXX)" required>
                </div>
                <div class="input-group">
                    <input type="text" id="cpf" name="cpf" placeholder="CPF (XXX.XXX.XXX-XX)" required>
                </div>

                <!-- Endereço -->
                <div class="input-group">
                    <input type="text" id="cep" name="cep" placeholder="CEP (XXXXX-XXX)" required maxlength="10">
                </div>

                <div class="input-group">
                    <input type="text" id="estado" name="estado" placeholder="Estado" required readonly>
                </div>
                <div class="input-group">
                    <input type="text" id="cidade" name="cidade" placeholder="Cidade" required readonly>
                </div>
                <div class="input-group">
                    <input type="text" id="bairro" name="bairro" placeholder="Bairro" required readonly>
                </div>
                <div class="input-group">
                    <input type="text" id="rua" name="rua" placeholder="Rua" required>
                </div>
                <div class="input-group">
                    <input type="text" id="numero" name="numero" placeholder="Número" required>
                </div>
                <div class="input-group">
                    <input type="text" id="complemento" name="complemento" placeholder="Complemento">
                </div>

                <!-- Separação para senha -->
                <div class="password-section">
                    <div class="input-group">
                        <input type="password" id="password" name="password" placeholder="Senha" required>
                    </div>
                    <div class="input-group">
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmar Senha" required>
                    </div>
                </div>

                <button type="submit" class="register-button">Criar conta</button>
            </form>
        </section>
    </div>
    <footer>
        <div class="footer">
            <div class="img-footer-start">
                <img class="boneco-footer" class="img-footer" src="../../assets/img-footer.png">
            </div>
            <div class="socias">
                <div class="icons-col-1">
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/google.png">
                        <p>novocomeço@gmail.com</p>
                    </div>
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/instagram.png">
                        <p>@novocomeço</p>
                    </div>
                </div>
                <div class="icons-col-2">
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/whatsapp.png">
                        <p>(41)99997676</p>
                    </div>
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/facebook.png">
                        <p>@novocomeco</p>
                    </div>
                </div>
            </div>
            <div class="img-footer-end">
                <img class="boneco-footer" class="img-footer" src="../../assets/img-footer.png">
            </div>
        </div>
    </footer>
    <script src="../../js/header.js"></script>

    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

    <script src="../../js/cadastro-administrador.js"></script>
</body>

<?php
// Para exibir uma mensagem de sucesso
if (isset($_SESSION['admin_nome'])) {
    echo "<p>Administrador " . $_SESSION['admin_nome'] . " cadastrado com sucesso!</p>";
}
?>

</html>