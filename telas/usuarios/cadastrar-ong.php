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
            <h2 class="section-title">ONG</h2>
            <p>Crie sua conta e ajude o próximo!</p>
            <form action="../../register-ong.php" method="POST">
                <!-- Informações Básicas -->
                <div class="input-group">
                    <input type="text" id="name" name="name" placeholder="Nome ONG" required>
                </div>
                <div class="input-group">
                    <input type="text" id="cnpj" name="cnpj" placeholder="CNPJ (XX.XXX.XXX/0001-XX)" required>
                </div>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="E-mail" required>
                </div>
                <div class="input-group">
                    <input type="tel" id="phone" name="phone" placeholder="Telefone (XX-XXXXXXXXX)" required>
                </div>

                <!-- Documentos -->
                <div class="input-group">
                    <input type="text" id="constituicao" name="constituicao" placeholder="Constituição" required>
                </div>
                <div class="input-group">
                    <input type="text" id="comprobatorio" name="comprobatorio" placeholder="Comprobatório" required>
                </div>
                <div class="input-group">
                    <input type="text" id="estatuto" name="estatuto" placeholder="Estatuto Social" required>
                </div>

                <!-- Endereço -->
                <div class="input-group">
                    <input type="text" id="cep" name="cep" placeholder="CEP (XXXXX-XXX)" required maxlength="10">
                </div>
                <div class="input-group">
                    <input type="text" id="estado" name="estado" placeholder="Estado" required>
                </div>
                <div class="input-group">
                    <input type="text" id="cidade" name="cidade" placeholder="Cidade" required>
                </div>
                <div class="input-group">
                    <input type="text" id="bairro" name="bairro" placeholder="Bairro" required>
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

                <!-- Informações Bancárias -->
                <div class="input-group">
                    <input type="text" id="bank_account" name="bank_account" placeholder="Conta Bancária" required>
                </div>
                <div class="input-group">
                    <input type="text" id="current_account" name="current_account" placeholder="Conta Corrente" required>
                </div>
                <div class="input-group">
                    <input type="text" id="pix_key" name="pix_key" placeholder="Chave Pix" required>
                </div>

                <!-- Senha - sempre por último -->
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Senha" required>
                </div>
                <div class="input-group">
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmar Senha" required>
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

    <script src="../../js/cadastro-ong.js"></script>
</body>

</html>