<?php

session_start();

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../../db.php'); // Certifique-se que o caminho está correto
    
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    
    // Validação básica
    if(empty($email) || empty($senha)) {
        echo "<div class='error-message'>Por favor, preencha todos os campos.</div>";
        exit();
    }

    try {
        // Verificar na tabela de Administradores
        $sql_admin = "SELECT * FROM ADMINISTRADOR WHERE email = ? AND senha = ?";
        $stmt = $conn->prepare($sql_admin);
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $result_admin = $stmt->get_result();

        // Verificar na tabela de Doadores
        $sql_doador = "SELECT * FROM DOADOR WHERE email = ? AND senha = ?";
        $stmt2 = $conn->prepare($sql_doador);
        $stmt2->bind_param("ss", $email, $senha);
        $stmt2->execute();
        $result_doador = $stmt2->get_result();

        // Verificar na tabela de ONGs
        $sql_ong = "SELECT * FROM ONG WHERE email = ? AND senha = ?";
        $stmt3 = $conn->prepare($sql_ong);
        $stmt3->bind_param("ss", $email, $senha);
        $stmt3->execute();
        $result_ong = $stmt3->get_result();

        // Verificar se o administrador existe
        if ($result_admin->num_rows > 0) {
            $admin = $result_admin->fetch_assoc();
            $_SESSION['user_id'] = $admin['id_administrador'];
            $_SESSION['user_nome'] = $admin['nome'];
            $_SESSION['user_email'] = $admin['email'];
            $_SESSION['user_tipo'] = 'administrador';
            $_SESSION['logged_in'] = true;
            
            echo "<div class='success-message'>Login realizado com sucesso!</div>";
            echo "<script>
                setTimeout(function() {
                    window.location.href = '/telas/administrador/home_administrador.php';
                }, 2000);
            </script>";
            exit();
        }
        // Verificar se o doador existe
        elseif ($result_doador->num_rows > 0) {
            $doador = $result_doador->fetch_assoc();
            $_SESSION['user_id'] = $doador['id_doador'];
            $_SESSION['user_nome'] = $doador['nome'];
            $_SESSION['user_email'] = $doador['email'];
            $_SESSION['user_tipo'] = 'doador';
            $_SESSION['logged_in'] = true;
            
            echo "<div class='success-message'>Login realizado com sucesso!</div>";
            echo "<script>
                setTimeout(function() {
                    window.location.href = '/telas/doador/home_doador.php';
                }, 2000);
            </script>";
            exit();
        }
        // Verificar se a ONG existe
        elseif ($result_ong->num_rows > 0) {
            $ong = $result_ong->fetch_assoc();
            $_SESSION['user_id'] = $ong['id_ong'];
            $_SESSION['user_nome'] = $ong['nome'];
            $_SESSION['user_email'] = $ong['email'];
            $_SESSION['user_tipo'] = 'ong';
            $_SESSION['logged_in'] = true;
            
            echo "<div class='success-message'>Login realizado com sucesso!</div>";
            echo "<script>
                setTimeout(function() {
                    window.location.href = '/telas/ong/home_ong.php';
                }, 2000);
            </script>";
            exit();
        } else {
            echo "<div class='error-message'>Email ou senha inválidos.</div>";
        }

    } catch (Exception $e) {
        echo "<div class='error-message'>Erro ao realizar login. Tente novamente mais tarde.</div>";
    } finally {
        // Fechar todas as conexões
        if(isset($stmt)) $stmt->close();
        if(isset($stmt2)) $stmt2->close();
        if(isset($stmt3)) $stmt3->close();
        if(isset($conn)) $conn->close();
    }
}
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
                <button class="btn-icon-header" onclick="toggleSideBar()" aria-label="Abrir menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                    <button class="btn-icon-header" onclick="toggleSideBar()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                        </svg>
                    </button>
                    <div>
                        <img class="img-logo" id="logo" src="../../assets/logo.png" alt="Logo Novo Começo">
                    </div>
                    <div class="nav-links" id="nav-links">
                        <ul>
                            <li>
                                    <button class="btn-icon-header" onclick="toggleSideBar()" aria-label="Fechar menu">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-x" viewBox="0 0 16 16">
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
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
                <form id="loginForm" action="login.php" method="POST" novalidate>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu email" required aria-required="true">

                    <form method="POST">
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Digite seu email" required>
                        </div>

                        <div class="input-group">
                            <label for="password">Senha</label>

                                <input type="password" id="password" name="senha" placeholder="Digite sua senha" required aria-required="true">
                                =======
                                <input type="password" id="password" name="senha" placeholder="Digite sua senha" required>
                        </div>

                        <div class="secondary-action">
                                <a href="../usuarios/alterar-senha.php" class="esqueci-senha">Esqueci minha senha</a>
                                <a href="../usuarios/alterar-senha.php" class="esqueci-senha">
                                </a>
                        </div>

                        <div class="action-buttons">
                            <button type="submit" class="action-button">
                                Entrar
                            </button>
                        </div>

                        <div class="secondary-action div-cadastrar">
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

</body>

</html>