<?php
session_start();

// Verifica se o usuário está logado
$logado = isset($_SESSION['usuario_tipo']); // Verifica se algum tipo de usuário está logado
$tipo_usuario = $_SESSION['usuario_tipo'] ?? null; // Armazena o tipo de usuário (adm, ong, doador)

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

    <h1>Bem-vindo à Página Inicial</h1>
    <p>Conteúdo público disponível para todos os visitantes.</p>

    <?php if ($logado): ?>
        <!-- Se o usuário estiver logado, o botão leva ao perfil específico -->
        <a href="
            <?php
            // Redireciona para o painel adequado com base no tipo de usuário
            switch ($tipo_usuario) {
                case 'adm':
                    echo 'painel_admin.php';
                    break;
                case 'ong':
                    echo 'painel_ong.php';
                    break;
                case 'doador':
                    echo 'painel_doador.php';
                    break;
            }
            ?>
        ">
            <button>Ir para o Meu Perfil</button>
        </a>
    <?php else: ?>
        <!-- Se o usuário não estiver logado, o botão leva para a página de login -->
        <a href="login.php">
            <button>Login</button>
        </a>
    <?php endif; ?>

</body>
</html>
