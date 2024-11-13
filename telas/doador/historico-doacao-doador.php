<?php
session_start(); // Inicia a sessão

// Verifica se a variável de sessão 'is_doador' está setada e é verdadeira
if (!isset($_SESSION['is_doador']) || $_SESSION['is_doador'] !== true) {
    // Se não for doador, redireciona para a página de login
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Doação</title>
    <link rel="shortcut icon" href="../../assets/logo.png" type="Alegrinho">
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/historico-doacoes.css">
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
                <a href="../../telas/doador/configuracoes.doador.php">
                    <img class="img-user" src="../../assets/user.png" alt="Usuário">
                </a>
            </div>
        </nav>
    </header>
    <div class="container">
        <h1 class="title">Histórico de doações</h1>
        <div class="filter-options">
            <select id="filter-ong">
                <option value="all">Mostrar todas as ONGs</option>
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
                <option value="ong11">ONG 11</option>
                <option value="ong12">ONG 12</option>
            </select>

            <div class="date-filters">
                <label for="start-date">De:</label>
                <input type="date" id="start-date" placeholder="Data de Início">
                <label for="end-date">Até:</label>
                <input type="date" id="end-date" placeholder="Data de Término">
                <button class="filter-btn" onclick="filterDonations()">Filtrar</button>
            </div>
        </div>

        <!-- Boxes de Doação -->
        <div class="donation-box" data-ong="ong1" data-date="2023-11-01">
            <div class="circle">
                <p>ONG: xxx</p>
            </div>
            <div class="donation-details">
                <p>Doação para a ONG xxx</p>
                <p>Data de doação: 01/11/2023</p>
                <p>Valor da doação: R$ 100,00</p>
            </div>
        </div>
        <div class="donation-box" data-ong="ong2" data-date="2023-11-10">
            <div class="circle">
                <p>ONG: yyy</p>
            </div>
            <div class="donation-details">
                <p>Doação para a ONG yyy</p>
                <p>Data de doação: 10/11/2023</p>
                <p>Valor da doação: R$ 150,00</p>
            </div>
        </div>
        <div class="donation-box" data-ong="ong3" data-date="2023-11-15">
            <div class="circle">
                <p>ONG: zzz</p>
            </div>
            <div class="donation-details">
                <p>Doação para a ONG zzz</p>
                <p>Data de doação: 15/11/2023</p>
                <p>Valor da doação: R$ 200,00</p>
            </div>
        </div>
        <!-- Novas ONGs -->
        <div class="donation-box" data-ong="ong4" data-date="2023-11-20">
            <div class="circle">
                <p>ONG: aaa</p>
            </div>
            <div class="donation-details">
                <p>Doação para a ONG aaa</p>
                <p>Data de doação: 20/11/2023</p>
                <p>Valor da doação: R$ 250,00</p>
            </div>
        </div>
        <div class="donation-box" data-ong="ong5" data-date="2023-11-25">
            <div class="circle">
                <p>ONG: bbb</p>
            </div>
            <div class="donation-details">
                <p>Doação para a ONG bbb</p>
                <p>Data de doação: 25/11/2023</p>
                <p>Valor da doação: R$ 300,00</p>
            </div>
        </div>
        <div class="donation-box" data-ong="ong6" data-date="2023-11-30">
            <div class="circle">
                <p>ONG: ccc</p>
            </div>
            <div class="donation-details">
                <p>Doação para a ONG ccc</p>
                <p>Data de doação: 30/11/2023</p>
                <p>Valor da doação: R$ 350,00</p>
            </div>
        </div>
        <div class="donation-box" data-ong="ong7" data-date="2023-12-01">
            <div class="circle">
                <p>ONG: ddd</p>
            </div>
            <div class="donation-details">
                <p>Doação para a ONG ddd</p>
                <p>Data de doação: 01/12/2023</p>
                <p>Valor da doação: R$ 400,00</p>
            </div>
        </div>
        <div class="donation-box" data-ong="ong8" data-date="2023-12-05">
            <div class="circle">
                <p>ONG: eee</p>
            </div>
            <div class="donation-details">
                <p>Doação para a ONG eee</p>
                <p>Data de doação: 05/12/2023</p>
                <p>Valor da doação: R$ 450,00</p>
            </div>
        </div>
        <div class="donation-box" data-ong="ong9" data-date="2023-12-10">
            <div class="circle">
                <p>ONG: fff</p>
            </div>
            <div class="donation-details">
                <p>Doação para a ONG fff</p>
                <p>Data de doação: 10/12/2023</p>
                <p>Valor da doação: R$ 500,00</p>
            </div>
        </div>
        <div class="donation-box" data-ong="ong10" data-date="2023-12-15">
            <div class="circle">
                <p>ONG: ggg</p>
            </div>
            <div class="donation-details">
                <p>Doação para a ONG ggg</p>
                <p>Data de doação: 15/12/2023</p>
                <p>Valor da doação: R$ 550,00</p>
            </div>
        </div>
        <div class="donation-box" data-ong="ong11" data-date="2023-12-20">
            <div class="circle">
                <p>ONG: hhh</p>
            </div>
            <div class="donation-details">
                <p>Doação para a ONG hhh</p>
                <p>Data de doação: 20/12/2023</p>
                <p>Valor da doação: R$ 600,00</p>
            </div>
        </div>
        <div class="donation-box" data-ong="ong12" data-date="2023-12-25">
            <div class="circle">
                <p>ONG: iii</p>
            </div>
            <div class="donation-details">
                <p>Doação para a ONG iii</p>
                <p>Data de doação: 25/12/2023</p>
                <p>Valor da doação: R$ 650,00</p>
            </div>
        </div>
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

    <script src="../../js/header.js"></script>
    <script src="../../js/doacoes.js"></script>
</body>

</html>