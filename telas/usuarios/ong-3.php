<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']); // Verifica se o usuário está logado
$tipoUsuario = $_SESSION['user_tipo'] ?? null; // Armazena o tipo de usuário, caso esteja logado

// Verifica e inicializa variáveis se não estiverem definidas
$ong_id = isset($_GET['ong']) ? $_GET['ong'] : null; // ou um valor padrão, como '1'
$valor = isset($_GET['valor']) ? $_GET['valor'] : '0.00';
$taxa = isset($_GET['taxa']) ? $_GET['taxa'] : '0.00';
$nome_doador = isset($_GET['doador']) ? $_GET['doador'] : 'Anônimo';

$ong_id_selecionada = isset($_GET['ong']) ? $_GET['ong'] : null;
?>


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
                <img src="../../assets/ong-3.png" alt="Imagem da ONG">
            </div>
            <div class="ong-description-box">
                <p>A ONG Cultivando a Vida atua em projetos socioambientais, promovendo práticas sustentáveis, educação ambiental e apoio à agricultura familiar. Seu objetivo é incentivar o equilíbrio entre o desenvolvimento humano e o cuidado com a natureza.</p>
            </div>

            <div class="error-message" id="error-message" style="display: none;">
                <div class="error-popup">
                    <p><strong>Erro:</strong> O valor da doação deve ser no mínimo R$5.</p>
                    <button class="close-btn" onclick="closeErrorPopup()">X</button>
                </div>
            </div>

            <div class="input-box">
                <label for="ong">Selecione uma ONG:</label>
                <select id="ong" name="ong" onchange="redirecionarParaOng()">
                    <option value="" <?php echo ($ong_id == '') ? 'selected' : ''; ?>>Selecione uma ONG</option>
                    <option value="1" <?php echo ($ong_id == 1) ? 'selected' : ''; ?>>Mão Amiga</option>
                    <option value="2" <?php echo ($ong_id == 2) ? 'selected' : ''; ?>>Amigos do Bem</option>
                    <option value="3" <?php echo ($ong_id == 3) ? 'selected' : ''; ?>>Cultivando a Vida</option>
                    <option value="4" <?php echo ($ong_id == 4) ? 'selected' : ''; ?>>Mais União</option>
                    <option value="5" <?php echo ($ong_id == 5) ? 'selected' : ''; ?>>Amigos da Terra</option>
                    <option value="6" <?php echo ($ong_id == 6) ? 'selected' : ''; ?>>Amor Animal</option>
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
        function redirecionarParaOng() {
            const ongId = document.getElementById('ong').value;

            // Redireciona para a página da ONG correspondente
            window.location.href = `ong-${ongId}.php`;
        }


        function validateDonation() {
            const valor = document.getElementById('valor').value;
            const ong_id = document.getElementById('ong').value; // Exemplo: "6" para Amor Animal

            if (valor >= 5) {
                const taxa = (valor * 0.05).toFixed(2); // 5% do valor

                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
                    const nome_doador = '<?php echo $_SESSION['user_nome'] ?? "Anônimo"; ?>';
                    window.location.href = `../doador/realizar-pagamento.php?ong=${ong_id}&valor=${valor}&taxa=${taxa}&doador=${nome_doador}`;
                <?php } else { ?>
                    alert('Você precisa estar logado para realizar uma doação.');
                <?php } ?>
            } else {
                document.getElementById('error-message').style.display = 'flex';
            }
        }



        function closeErrorPopup() {
            document.getElementById('error-message').style.display = 'none';
        }


        function closeErrorPopup() {
            document.getElementById('error-message').style.display = 'none';
        }

        function validateDonation() {
            const valor = document.getElementById('valor').value;
            const nome_ong = document.getElementById('ong').value;

            if (valor >= 5) {
                const taxa = (valor * 0.05).toFixed(2); // 5% do valor

                // Verifica se o usuário está logado
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
                    // Redireciona para a página de pagamento, passando as variáveis necessárias
                    const nome_doador = '<?php echo $_SESSION['user_nome'] ?? "Anônimo"; ?>';
                    window.location.href = `../doador/realizar-pagamento.php?ong=${nome_ong}&valor=${valor}&taxa=${taxa}&doador=${nome_doador}`;
                <?php } else { ?>
                    alert('Você precisa estar logado para realizar uma doação.');
                <?php } ?>
            } else {
                document.getElementById('error-message').style.display = 'flex';
            }
        }
    </script>
</body>

</html>