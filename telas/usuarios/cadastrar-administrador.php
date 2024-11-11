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
        <section class="register-section">
            <h1>Criar conta</h1>
            <p>Crie sua conta de administrador</p>
            <form action="/admin/register" method="POST" class="admin-form">
                <div class="input-group">
                    <input type="text" id="name" name="name" placeholder="Nome Completo" maxlength="100" required>
                </div>
                <div class="input-group">
                    <input type="text" id="cpf" name="cpf" placeholder="CPF" maxlength="14" pattern="\d{3}\.?\d{3}\.?\d{3}-?\d{2}" title="Digite um CPF válido"></div>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Email" maxlength="100" required>
                </div>
                <div class="input-group">
                    <input type="tel" id="telefone" name="telefone" placeholder="Telefone" maxlength="15" pattern="\(\d{2}\)\s?\d{4,5}-?\d{4}">
                </div>
                <div class="input-group">
                    <input type="text" id="end_estado" name="end_estado" placeholder="Estado (UF)" maxlength="2" pattern="[A-Za-z]{2}" required>
                </div>
                <div class="input-group">
                    <input type="text" id="end_cidade" name="end_cidade" placeholder="Cidade" maxlength="50" required>
                </div>
                <div class="input-group">
                    <input type="text" id="end_bairro" name="end_bairro" placeholder="Bairro" maxlength="50" required>
                </div>
                <div class="input-group">
                    <input type="text" id="end_rua" name="end_rua" placeholder="Rua" maxlength="100" required>
                </div>
                <div class="input-group">
                    <input type="text" id="end_numero" name="end_numero" placeholder="Número" maxlength="10" required>
                </div>
                <div class="input-group">
                    <input type="text" id="end_completento" name="end_completento" placeholder="Complemento" maxlength="50">
                </div>
                <div class="input-group">
                    <input type="password" id="senha" name="senha" placeholder="Senha" minlength="8" required>
                </div>
                <div class="input-group">
                    <input type="password" id="confirm_senha" name="confirm_senha" placeholder="Confirme a Senha" minlength="8" required>
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
</body>
</html> 