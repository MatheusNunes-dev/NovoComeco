<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include('../../db.php'); // Caminho para o arquivo db.php

// Captura o nome do arquivo da URL
$current_url = $_SERVER['REQUEST_URI'];

// Usa uma expressão regular para capturar o número após "ong-" no nome do arquivo
if (preg_match('/ong-(\d+)\.php/', $current_url, $matches)) {
    $ong_id = $matches[1];  // O número após "ong-" será o ID da ONG
    echo "ID da ONG capturado: " . $ong_id . "<br>";
}

// Verifica se o ID da ONG foi encontrado
if (isset($ong_id)) {


    $sql = "SELECT id_ong, nome, chave_pix FROM ONG WHERE id_ong = ?";
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $ong_id); // "i" para inteiro (id_ong)
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se a ONG foi encontrada
        if ($result && $row = $result->fetch_assoc()) {
            $nome_ong = $row['nome']; // Nome da ONG
            $chave_pix = $row['chave_pix']; // Chave PIX da ONG
        } else {
            echo "ONG não encontrada.";
        }
    } else {
        echo "Erro na consulta SQL.";
    }
} else {
    echo "ID da ONG não especificado.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $valor = floatval($_POST['valor']);
    $valor_taxa = $valor * 0.05; // 5% fee
    $cpf_admin = $_POST['cpf_admin'];
    $data_emissao = $_POST['data_emissao'];
    $data_vencimento = $_POST['data_vencimento'];
    $metodo_pagamento = $_POST['metodo_pagamento'];

    // Get id_administrador based on CPF
    $sql_admin = "SELECT id_administrador FROM ADMINISTRADOR WHERE cpf = ?";
    $stmt_admin = $mysqli->prepare($sql_admin);
    $stmt_admin->bind_param("s", $cpf_admin);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();
    $admin_row = $result_admin->fetch_assoc();
    $id_administrador = $admin_row['id_administrador'];

    // Insert into BOLETO table
    $sql_insert = "INSERT INTO BOLETO (
        id_ong,
        id_administrador,
        valor_taxa,
        data_emissao,
        data_vencimento,
        status_pagamento,
        metodo_pagamento,
        mes_referencia
    ) VALUES (?, ?, ?, ?, ?, 'pendente', ?, DATE_FORMAT(NOW(), '%Y-%m'))";

    $stmt_insert = $mysqli->prepare($sql_insert);
    $stmt_insert->bind_param(
        "iidsss",
        $ong_id,
        $id_administrador,
        $valor_taxa,
        $data_emissao,
        $data_vencimento,
        $metodo_pagamento
    );

    if ($stmt_insert->execute()) {
        echo "Boleto registrado com sucesso!";
    } else {
        echo "Erro ao registrar boleto: " . $mysqli->error;
    }

    $stmt_admin->close();
    $stmt_insert->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doação ONG</title>
    <link rel="shortcut icon" href="../../assets/logo.png" type="Alegrinho">
    <link rel="stylesheet" href="../../css/todos-global.css">
    <link rel="stylesheet" href="../../css/todos-pagina-ong.css">
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
            <h1 class="ong-name">Realizar Transferência</h1>
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

            <form method="POST" action="" onsubmit="return validateDonation()">
                <div class="input-box">
                    <label for="valor">Valores acima de R$5:</label>
                    <input type="number" id="valor" name="valor" placeholder="Digite o valor da doação (somente números)" required>
                </div>
                <div class="input-box">
                    <label for="nome_ong">Nome da ONG:</label>
                    <input type="text" id="nome_ong" name="nome_ong" value="Mão Amiga" readonly>
                </div>
                <div class="input-box">
                    <label for="cpf_admin">CPF do Administrador:</label>
                    <input type="text" id="cpf_admin" name="cpf_admin" placeholder="XXX-XXX-XXX-XX" required>
                </div>
                <div class="input-box">
                    <label for="data_emissao">Data de Emissão:</label>
                    <input type="date" id="data_emissao" name="data_emissao" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
                <div class="input-box">
                    <label for="data_vencimento">Data de Vencimento:</label>
                    <input type="date" id="data_vencimento" name="data_vencimento" value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>" readonly>
                </div>
                <div class="input-box">
                    <label for="metodo_pagamento">Método de Pagamento:</label>
                    <input type="text" id="metodo_pagamento" name="metodo_pagamento" value="PIX" readonly>
                </div>

                <div class="button-container">
                    <div class="cancel-button" onclick="window.location.href='../usuarios/pagina-quero-doar.php'">
                        <p>Cancelar doação</p>
                    </div>
                    <button type="submit" class="confirm-button">
                        <p>Confirmar doação</p>
                    </button>
                </div>
            </form>

        </section>
    </main>

    <footer>
        <div class="footer">
            <!-- Conteúdo do rodapé -->
        </div>
    </footer>
    <script>
        function validateDonation() {
            const valor = document.getElementById('valor').value;
            const ong_id = <?php echo $ong_id; ?>; // A ONG já está definida na URL

            if (valor >= 5) {
                const taxa = (valor * 0.05).toFixed(2); // Calcula a taxa de 5% do valor

                if (ong_id !== "") {
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== null) { ?>
                        const nome_doador = '<?php echo $_SESSION['user_nome'] ?? "Anônimo"; ?>';
                        // Redireciona para a página de pagamento, passando os parâmetros necessários
                        window.location.href = `../doador/realizar-pagamento.php?ong=${ong_id}&valor=${valor}&taxa=${taxa}&doador=${nome_doador}`;
                    <?php } else { ?>
                        window.location.href = `../usuarios/login.php`;
                    <?php } ?>
                }
            } else {
                document.getElementById("error-message").style.display = "block";
            }
        }

        function closeErrorPopup() {
            document.getElementById("error-message").style.display = "none";
        }
    </script>
</body>

</html>