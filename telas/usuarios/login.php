<?php

include('../../db.php');

// Conecta ao banco de dados com SSL
if (!$mysqli->real_connect($servername, $username, $password, $dbname, $port, NULL, MYSQLI_CLIENT_SSL)) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

// Código de inserção
$sql_code = "INSERT INTO DOADOR(nome, email, senha, telefone, cpf, data_cadastro, end_rua, end_numero, end_bairro, end_cidade, end_estado, end_complemento) 
             VALUES ('Mathesu', 'mthanus@gmail.com', 'matheus', '41991839622', '08540931984', '2024-11-13', 'a', 'a', 'a', 'a', 'a', 'a')";

// Executa a consulta
$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

// Exibe mensagem de sucesso
echo "Registro inserido com sucesso!";

// Fecha a conexão
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Página de login do Novo Começo. Faça login para acessar sua conta.">
    <title>Login - Novo Começo</title>
    <link rel="shortcut icon" href="../../assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/login-geral.css">
</head>

<body>
    <header>
        <nav class="navbar nav-lg-screen" id="navbar">
            <<<<<<< HEAD
                <button class="btn-icon-header" onclick="toggleSideBar()" aria-label="Abrir menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                    =======
                    <button class="btn-icon-header" onclick="toggleSideBar()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                            >>>>>>> 137f6d9cad2eb70cc142f14f9226d3d37d4ce5f1
                        </svg>
                    </button>
                    <div>
                        <img class="img-logo" id="logo" src="../../assets/logo.png" alt="Logo Novo Começo">
                    </div>
                    <div class="nav-links" id="nav-links">
                        <ul>
                            <li>
                                <<<<<<< HEAD
                                    <button class="btn-icon-header" onclick="toggleSideBar()" aria-label="Fechar menu">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-x" viewBox="0 0 16 16">
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                        =======
                                        <button class="btn-icon-header" onclick="toggleSideBar()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                                >>>>>>> 137f6d9cad2eb70cc142f14f9226d3d37d4ce5f1
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
                        <a href="../../telas/usuarios/login.php" aria-label="Página de login">
                            <img class="img-user" src="../../assets/user.png" alt="Usuário">
                        </a>
                    </div>
        </nav>
    </header>

    <main>
        <h1 class="title">LOGIN</h1>

        <section class="login">
            <<<<<<< HEAD
                <form id="loginForm" action="" method="POST" novalidate>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu email" required aria-required="true">
                    =======
                    <form method="POST">
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Digite seu email" required>
                            >>>>>>> 137f6d9cad2eb70cc142f14f9226d3d37d4ce5f1
                        </div>

                        <div class="input-group">
                            <label for="password">Senha</label>
                            <<<<<<< HEAD
                                <input type="password" id="password" name="senha" placeholder="Digite sua senha" required aria-required="true">
                                =======
                                <input type="password" id="password" name="senha" placeholder="Digite sua senha" required>
                                >>>>>>> 137f6d9cad2eb70cc142f14f9226d3d37d4ce5f1
                        </div>

                        <div class="secondary-action">
                            <<<<<<< HEAD
                                <a href="../usuarios/alterar-senha.php" class="esqueci-senha">Esqueci minha senha</a>
                                =======
                                <a href="../usuarios/alterar-senha.php" class="esqueci-senha">
                                    Esqueci minha senha
                                </a>
                                >>>>>>> 137f6d9cad2eb70cc142f14f9226d3d37d4ce5f1
                        </div>

                        <div class="action-buttons">
                            <button type="submit" class="action-button">
                                Entrar
                            </button>
                        </div>

                        <div class="secondary-action div-cadastrar">
                            <<<<<<< HEAD
                                <p>Não tem uma conta? Cadastrar-se como
                                <a href="../usuarios/cadastrar-administrador.php" class="cadastrar">Administrador</a> /
                                <a href="../usuarios/cadastrar-doador.php" class="cadastrar">Doador</a> /
                                <a href="../usuarios/cadastrar-ong.php" class="cadastrar">ONG</a>
                                </p>
                                =======
                                <p>Não Tem Uma Conta? Cadastrar-se como:</p>
                                <div class="opcoes-cadastro">
                                    <a href="cadastrar-administrador.php">Administrador</a>
                                    <a href="cadastrar-doador.php">Doador</a>
                                    <a href="cadastrar-ong.php">ONG</a>
                                </div>
                                >>>>>>> 137f6d9cad2eb70cc142f14f9226d3d37d4ce5f1
                        </div>

                    </form>
        </section>
    </main>

    <footer>
        <div class="footer">
            <div class="img-footer-start">
                <img class="boneco-footer" src="../../assets/img-footer.png" alt="Boneco footer">
            </div>
            <div class="sociais">
                <div class="icons-col-1">
                    <div class="social-footer">
                        <<<<<<< HEAD
                            <img class="icon-footer" src="../../assets/google.png" alt="Ícone do Gmail">
                            <p>novocomeço@gmail.com</p>
                    </div>
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/instagram.png" alt="Ícone do Instagram">
                        =======
                        <img class="icon-footer" src="../../assets/google.png" alt="Google">
                        <p>novocomeço@gmail.com</p>
                    </div>
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/instagram.png" alt="Instagram">
                        >>>>>>> 137f6d9cad2eb70cc142f14f9226d3d37d4ce5f1
                        <p>@novocomeço</p>
                    </div>
                </div>
                <div class="icons-col-2">
                    <div class="social-footer">
                        <<<<<<< HEAD
                            <img class="icon-footer" src="../../assets/whatsapp.png" alt="Ícone do WhatsApp">
                            <p>(41)99997676</p>
                    </div>
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/facebook.png" alt="Ícone do Facebook">
                        =======
                        <img class="icon-footer" src="../../assets/whatsapp.png" alt="WhatsApp">
                        <p>(41)99997676</p>
                    </div>
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/facebook.png" alt="Facebook">
                        >>>>>>> 137f6d9cad2eb70cc142f14f9226d3d37d4ce5f1
                        <p>@novocomeco</p>
                    </div>
                </div>
            </div>
            <div class="img-footer-end">
                <img class="boneco-footer" src="../../assets/img-footer.png" alt="Boneco footer">
            </div>
        </div>
    </footer>

    <script src="../../js/header.js"></script>
    <<<<<<< HEAD
        <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');

        // Validação do formulário antes de submeter
        const form = document.getElementById('loginForm');
        form.addEventListener('submit', function(event) {
        let email = document.getElementById('email').value;
        let senha = document.getElementById('password').value;
        if (email === '' || senha === '') {
        event.preventDefault();
        alert('Por favor, preencha todos os campos.');
        }
        });
        </script>
        =======
        >>>>>>> 137f6d9cad2eb70cc142f14f9226d3d37d4ce5f1
</body>

</html>