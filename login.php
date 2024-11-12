<?php
session_start();  // Inicia a sessão

// Conectar ao banco de dados
$servername = "localhost";  // Ou seu servidor MySQL
$username = "root";         // Usuário do banco de dados
$password = "";             // Senha do banco de dados
$dbname = "novocomeco";     // Nome do banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificar na tabela de Administradores
    $sql_admin = "SELECT * FROM ADMINISTRADOR WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql_admin);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result_admin = $stmt->get_result();

    // Verificar na tabela de Doadores
    $sql_doador = "SELECT * FROM DOADOR WHERE email = ? AND senha = ?";
    $stmt2 = $conn->prepare($sql_doador);
    $stmt2->bind_param("ss", $email, $senha);
    $stmt2->execute();
    $result_doador = $stmt2->get_result();

    // Verificar na tabela de ONGs
    $sql_ong = "SELECT * FROM ONG WHERE email = ? AND senha = ?";
    $stmt3 = $conn->prepare($sql_ong);
    $stmt3->bind_param("ss", $email, $senha);
    $stmt3->execute();
    $result_ong = $stmt3->get_result();

    // Verificar se o administrador existe
    if ($result_admin->num_rows > 0) {
        $admin = $result_admin->fetch_assoc();
        $_SESSION['admin_id'] = $admin['id_administrador'];
        $_SESSION['admin_nome'] = $admin['nome'];
        header("Location: administrador_dashboard.php");  // Redireciona para a área administrativa
        exit();
    }
    // Verificar se o doador existe
    elseif ($result_doador->num_rows > 0) {
        $doador = $result_doador->fetch_assoc();
        $_SESSION['doador_id'] = $doador['id_doador'];
        $_SESSION['doador_nome'] = $doador['nome'];
        header("Location: doador_dashboard.php");  // Redireciona para a área do doador
        exit();
    }
    // Verificar se a ONG existe
    elseif ($result_ong->num_rows > 0) {
        $ong = $result_ong->fetch_assoc();
        $_SESSION['ong_id'] = $ong['id_ong'];
        $_SESSION['ong_nome'] = $ong['nome'];
        header("Location: ong_dashboard.php");  // Redireciona para a área da ONG
        exit();
    } else {
        // Caso o login seja inválido
        echo "Email ou senha inválidos.";
    }

    // Fechar a conexão
    $stmt->close();
    $stmt2->close();
    $stmt3->close();
    $conn->close();
}
