<?php
// Verifica se o usuário tem permissão para acessar a página de administrador
session_start(); // Inicia a sessão

// Verifica se a variável de sessão 'is_admin' está setada e é verdadeira
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // Se não for administrador, redireciona para uma página de erro ou página pública
    header('Location: ../usuarios/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doação ONG</title>
    <link rel="shortcut icon" href="../../assets/logo.png" type="Alegrinho">
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/transferencia.css">
    <style>
        /* O Modal */
        .modal {
            display: none;
            /* Esconde o modal por padrão */
            position: fixed;
            z-index: 1;
            /* Fica sobre o conteúdo */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            /* Fundo semitransparente */
            justify-content: center;
            align-items: center;
        }

        /* O conteúdo do Modal */
        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
            border-radius: 10px;
            position: relative;
        }

        /* O botão de fechar */
        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 25px;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }
    </style>
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

    <main>
        <div class="container">
            <section class="donation-box">
                <h1 class="ong-name">Transferir Para ONG</h1>
                <div class="donation-image">
                    <img src="../../assets/imagem-ong-1.jpg" alt="Imagem da ONG">
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
                    </select>
                </div>

                <div class="input-box">
                    <label for="valor">Valor (R$):</label>
                    <input type="number" id="valor" name="valor" placeholder="Digite o valor da transferência (somente números)" required>
                </div>

                <p class="note">*Somente PIX</p>
                <p class="note">*Mínimo: R$5</p>

                <div class="button-container">
                    <div class="cancel-button" onclick="window.location.href='../usuarios/pagina-quero-doar.php'">
                        <p>Cancelar doação</p>
                    </div>
                    <div class="confirm-button" onclick="confirmDonation()">
                        <p>Confirmar doação</p>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <div class="footer">
            <div class="img-footer-start">
                <img class="boneco-footer" src="../../assets/img-footer.png" alt="Imagem de rodapé 1" />
            </div>
            <div class="sociais">
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

    <!-- Pop-up de erro -->
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>O valor mínimo para doação é R$5,00. Por favor, insira um valor válido.</p>
        </div>
    </div>

    <script>
        function confirmDonation() {
            var valor = document.getElementById("valor").value;
            if (valor < 5) {
                // Exibe o pop-up de erro
                document.getElementById("errorModal").style.display = "flex";
            } else {
                // Redireciona para a página de pagamento
                window.location.href = "../doador/realizar-pagamento.php";
            }
        }

        function closeModal() {
            // Fecha o pop-up de erro
            document.getElementById("errorModal").style.display = "none";
        }
    </script>

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