<?php
session_start();  // Inicia a sessão

// Destroi todos os dados da sessão
session_unset();   // Remove todas as variáveis de sessão
session_destroy(); // Destroi a sessão

// Redireciona o usuário para a página de login
header("Location: telas/usuarios/login.php");
exit();
