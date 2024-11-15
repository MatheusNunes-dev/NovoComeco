<?php
session_start();

// Verificar se o usuário está logado como doador
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['user_tipo'] !== 'doador') {
    header("Location: /telas/usuarios/login.php");
    exit();
}

// Incluir o arquivo de conexão com o banco de dados
require '../../db.php';

// Preparar a consulta com filtros, se existirem
$query = "SELECT * FROM doacoes WHERE doador_id = ?";

// Verificar se há filtros aplicados
$filters = [];
if (isset($_GET['ong']) && $_GET['ong'] !== 'all') {
    $query .= " AND ong_nome = ?";
    $filters[] = $_GET['ong'];
}

if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $query .= " AND data BETWEEN ? AND ?";
    $filters[] = $_GET['start_date'];
    $filters[] = $_GET['end_date'];
}

// Preparar a consulta
$stmt = $mysqli->prepare($query);
$filters = array_merge([$stmt, "i", $_SESSION['user_id']], $filters); // Adicionando o ID do doador e os filtros
$stmt->bind_param(...$filters);

// Executar a consulta
$stmt->execute();
$result = $stmt->get_result();

// Processar os resultados e exibir na página
$donations = [];
while ($row = $result->fetch_assoc()) {
    $donations[] = $row;
}

// Fechar a conexão
$stmt->close();
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Doação</title>
    <link rel="shortcut icon" href="../../assets/logo.png" type="image/png">
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/historico-doacoes.css">
</head>

<body>
    <header>
        <nav class="navbar nav-lg-screen" id="navbar">
            <button class="btn-icon-header" onclick="toggleSideBar()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
            <div>
                <img class="img-logo" id="logo" src="../../assets/logo.png" alt="Logo">
            </div>
            <div class="nav-links" id="nav-links">
                <ul>
                    <li class="nav-link"><a href="../../telas/usuarios/index.php">HOME</a></li>
                    <li class="nav-link"><a href="../../telas/usuarios/pagina-quero-doar.php">ONG'S</a></li>
                    <li class="nav-link"><a href="../../telas/usuarios/sobre.php">SOBRE</a></li>
                    <li class="nav-link"><a href="../../telas/usuarios/contato.php">CONTATO</a></li>
                </ul>
            </div>
            <div class="user">
                <a href="../../telas/doador/configuracoes-doador.php">
                    <img class="img-user" src="../../assets/user.png" alt="Usuário">
                </a>
            </div>
        </nav>
    </header>

    <div class="container">
        <h1 class="title">Histórico de doações</h1>
        <div class="filter-options">
            <select id="filter-ong" onchange="filterDonations()">
                <option value="all">Mostrar todas as ONGs</option>
                <!-- Preencher dinamicamente as ONGs -->
                <?php
                $ongs = ["ONG 1", "ONG 2", "ONG 3", "ONG 4", "ONG 5", "ONG 6"];
                foreach ($ongs as $ong) {
                    echo "<option value='$ong'>$ong</option>";
                }
                ?>
            </select>

            <div class="date-filters">
                <label for="start-date">De:</label>
                <input type="date" id="start-date">
                <label for="end-date">Até:</label>
                <input type="date" id="end-date">
                <button class="filter-btn" onclick="filterDonations()">Filtrar</button>
            </div>
        </div>

        <!-- Exibição das doações -->
        <?php if (count($donations) > 0): ?>
            <?php foreach ($donations as $donation): ?>
                <div class="donation-box" data-ong="<?= htmlspecialchars($donation['ong_nome']) ?>" data-date="<?= htmlspecialchars($donation['data']) ?>">
                    <div class="circle">
                        <p>ONG: <?= htmlspecialchars($donation['ong_nome']) ?></p>
                    </div>
                    <div class="donation-details">
                        <p>Doação para a ONG <?= htmlspecialchars($donation['ong_nome']) ?></p>
                        <p>Data de doação: <?= htmlspecialchars($donation['data']) ?></p>
                        <p>Valor da doação: R$ <?= number_format($donation['valor'], 2, ',', '.') ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Você ainda não fez doações ou não há doações para exibir com os filtros selecionados.</p>
        <?php endif; ?>
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
    <script src="../../js/doacoes.js"></script>
</body>

</html>