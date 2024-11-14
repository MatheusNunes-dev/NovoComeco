<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doação ONG</title>
    <link rel="shortcut icon" href="../../assets/logo.png" type="Alegrinho">
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/pagina-da-ong.css">
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
            <h1 class="ong-name">Realizar Doação</h1>
            <div class="donation-image">
                <img src="../../assets/ong-1.png" alt="Imagem da ONG">
            </div>
            <div class="ong-description-box">
                <p>A ONG Mão Amiga é dedicada a oferecer assistência a comunidades em situação de vulnerabilidade social, fornecendo alimentos, roupas e suporte educacional. A organização acredita no poder da solidariedade e trabalha para promover dignidade e oportunidades para todos.</p>
            </div>

            <div class="error-message" id="error-message" style="display: none;">
                <div class="error-popup">
                    <p><strong>Erro:</strong> O valor da doação deve ser no mínimo R$5.</p>
                    <button class="close-btn" onclick="closeErrorPopup()">X</button>
                </div>
            </div>

            <div class="input-box">
                <label for="ong">Nome da ONG:</label>
                <select id="ong" name="ong" required onchange="redirectToOng()">
                    <option value="">Selecione uma ONG</option>
                    <option value="mao-amiga">Mão Amiga</option>
                    <option value="amigos-do-bem">Amigos do Bem</option>
                    <option value="cultivando-a-vida">Cultivando a Vida</option>
                    <option value="mais-uniao">Mais União</option>
                    <option value="amigos-da-terra">Amigos da Terra</option>
                    <option value="amor-animal">Amor Animal</option>
                </select>
            </div>


            <div class="input-box">
                <label for="valor">Valor (R$):</label>
                <input type="number" id="valor" name="valor" placeholder="Digite o valor da doação (somente números)" required>
            </div>

            <p class="note">*Somente PIX</p>
            <p class="note">*Minimo: R$5</p>

            <div class="button-container">
                <div class="cancel-button" onclick="window.location.href='../usuarios/pagina-quero-doar.php'">
                    <p>Cancelar doação</p>
                </div>
                <div class="confirm-button" onclick="validateDonation()">
                    <p>Confirmar doação</p>
                </div>
            </div>

        </section>
    </main>

    <footer>
        <div class="footer">
            <!-- Conteúdo do rodapé -->
        </div>
    </footer>

    <script>
        function redirectToOng() {
            const ong = document.getElementById('ong').value;

            // Define URLs de redirecionamento para cada ONG
            const urls = {
                "mao-amiga": "pagina-da-ong-1.php",
                "amigos-do-bem": "pagina-da-ong-2.php",
                "cultivando-a-vida": "pagina-da-ong-3.php",
                "mais-uniao": "pagina-da-ong-4.php",
                "amigos-da-terra": "pagina-da-ong-5.php",
                "amor-animal": "pagina-da-ong-6.php",
            };

            if (urls[ong]) {
                window.location.href = urls[ong];
            }
        }


        function closeErrorPopup() {
            document.getElementById('error-message').style.display = 'none';
        }
    </script>
</body>

</html>