<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doação ONG</title>
    <link rel="shortcut icon" href="../../assets/logo.png" type="Alegrinho">
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/pagina-da-ong-2.css">
</head>

<body>
    <header>
        <nav class="navbar nav-lg-screen" id="navbar" aria-label="Menu principal">
            <button class="btn-icon-header" onclick="toggleSideBar()" aria-label="Abrir menu lateral">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
            <div>
                <img class="img-logo" id="logo" src="../../assets/logo.png" alt="Logo da ONG" />
            </div>
            <div class="nav-links" id="nav-links">
                <ul>
                    <li><button class="btn-icon-header" onclick="toggleSideBar()" aria-label="Fechar menu lateral">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg>
                        </button></li>
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

    <main class="container">
        <section class="donation-box">
            <h1 class="ong-name">Realizar Doação</h1> <!-- O título fora da donation-box -->
            <div class="donation-image">
                <img src="../../assets/imagem-ong-1.jpg" alt="Imagem da ONG">
            </div>
            <div class="ong-description-box">
                <p>A ONG realiza várias atividades focadas no bem-estar social, educação e saúde da comunidade. A missão é melhorar as condições de vida das pessoas em situação de vulnerabilidade.</p>
            </div>

            <div class="input-box">
                <label for="ong">Nome da ONG:</label>

                <select id="ong" name="ong" required>
                    <option value="ong1">ONG 1</option>
                    <option value="ong2">ONG 2</option>
                    <option value="ong3">ONG 3</option>
                    <option value="ong4">ONG 4</option>
                    <option value="ong5">ONG 5</option>
                    <option value="ong6">ONG 6</option>
                    <option value="ong7">ONG 7</option>
                    <option value="ong8">ONG 8</option>
                    <option value="ong9">ONG 9</option>
                    <option value="ong10">ONG 10</option>
                    <!-- Adicione mais opções de ONGs aqui -->
                </select>
            </div>

            <div class="input-box">
                <label for="valor">Valor (R$):</label>
                <input type="number" id="valor" name="valor" placeholder="Digite o valor da doação (somente números)" required>
            </div>

            <!-- Notas ajustadas para aparecerem abaixo do campo -->
            <p class="note">*Somente PIX</p>
            <p class="note">*Minimo: R$5</p>

            <!-- Container dos botões confirm e cancel -->
            <div class="button-container">
                <div class="cancel-button" onclick="window.location.href='../usuarios/pagina-quero-doar.php'">
                    <p>Cancelar doação</p>
                </div>
                <div class="confirm-button" onclick="window.location.href='../doador/realizar-pagamento.php.'">
                    <p>Confirmar doação</p>
                </div>
            </div>

        </section>
    </main>

    <footer>
        <div class="footer">
            <div class="img-footer-start">
                <img class="boneco-footer" src="../../assets/img-footer.png" alt="Imagem de rodapé 1" />
            </div>
            <div class="socias">
                <div class="icons-col-1">
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/google.png" alt="Ícone do Google" />
                        <p>novocomeço@gmail.com</p>
                    </div>
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/instagram.png" alt="Ícone do Instagram" />
                        <p>@novocomeço</p>
                    </div>
                </div>
                <div class="icons-col-2">
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/whatsapp.png" alt="Ícone do WhatsApp" />
                        <p>(41)99997676</p>
                    </div>
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/facebook.png" alt="Ícone do Facebook" />
                        <p>@novocomeco</p>
                    </div>
                </div>
            </div>
            <div class="img-footer-end">
                <img class="boneco-footer" src="../../assets/img-footer.png" alt="Imagem de rodapé 2" />
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
</body>

</html>