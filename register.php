<?php
// register.php (ou outro arquivo de login onde o código de administrador é inserido)

session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];

    // Verifica se o código de administrador é 0000
    if ($codigo === '0000') {
        // Código correto, cria uma variável de sessão para identificar como administrador
        $_SESSION['is_admin'] = true;
        // Redireciona para a página de administração
        header('Location: telas/administrador/configuracoes-administrador.php');
        exit;
    } else {
        // Código incorreto, redireciona para a página de erro ou para outra página
        header('Location: telas/usuarios/cadastrar-doador.php?erro=codigo_invalido');
        exit;
    }
}
