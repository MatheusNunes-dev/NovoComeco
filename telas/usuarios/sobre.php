<?php
    session_start();
    $isLoggedIn = isset($_SESSION['user_id']); // Verifica se o usuário está logado
    $tipoUsuario = $_SESSION['user_tipo'] ?? null; // Armazena o tipo de usuário, caso esteja logado
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Começo</title>
    <link rel="shortcut icon" href="../../assets/logo.png" type="Alegrinho">
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/sobre.css">
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
                <?php if ($isLoggedIn): ?>
        <!-- Direciona para o perfil com base no tipo de usuário -->
                    <?php if ($tipoUsuario === 'administrador'): ?>
                        <a href="../administrador/configuracoes-administrador.php"><img class="img-user" src="../../assets/user.png" alt="Usuário"></a>
                    <?php elseif ($tipoUsuario === 'doador'): ?>
                        <a href="../doador/configuracoes-doador.php"><img class="img-user" src="../../assets/user.png" alt="Usuário"></a>
                    <?php elseif ($tipoUsuario === 'ong'): ?>
                        <a href="../ong/configuracoes-ong.php"><img class="img-user" src="../../assets/user.png" alt="Usuário"></a>
                    <?php endif; ?>
                <?php else: ?>
        <!-- Se o usuário não está logado, o botão leva para a página de login -->
                    <a href="login.php"><img class="img-user" src="../../assets/user.png" alt="Usuário"></a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <main>
        <section class="boxes">
            <div class="box">
                <h2 class="box-title">QUEM SOMOS?</h2>
                <p>
                    A Novo Começo é uma ONG intermediária que facilita o processo de doação entre ONGs e doadores, promovendo uma doação
                    inteligente e eficiente. Com o objetivo de dar início a novos ciclos e ajudar pessoas em situações de vulnerabilidade, a
                    Novo Começo conecta doadores a diversas causas, garantindo que as doações sejam direcionadas de forma transparente e
                    impactante. A organização atua como um elo, simplificando o processo de doação e potencializando o alcance das
                    iniciativas de solidariedade.
                </p>
            </div>
        </section>

        <section class="boxes">
            <div class="box">
                <h2 class="box-title">POR QUE DOAR? </h2>
                <p>
                    Doar é um ato que vai além da ajuda financeira; é uma forma de transformar vidas e contribuir para um mundo melhor.
                    Quando você doa, oferece a oportunidade de recomeço para aqueles que mais precisam, ajudando a suprir necessidades
                    básicas, como alimentação, saúde, e educação. Além disso, a doação promove igualdade social, fortalece comunidades e
                    inspira outras pessoas a fazerem o mesmo. É também uma forma de exercer empatia, solidariedade e responsabilidade
                    social, gerando impacto positivo tanto para quem recebe quanto para quem doa. Cada contribuição, por menor que pareça,
                    tem o poder de mudar destinos e criar um futuro mais justo e solidário.
                </p>
            </div>
        </section>

    </main>

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
</body>

</html>