<?php
session_start();
require __DIR__ . '/db.php'; // Inclui a conexão com o banco

// Verificar se o usuário está logado e é doador
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['user_tipo'] !== 'doador') {
    header("Location: telas/usuarios/login.php");
    exit();
}

$user_id = (int) $_SESSION['user_id']; // ID do doador logado

try {
    // Verificar o status atual do doador
    $check_sql = "SELECT status FROM DOADOR WHERE id_doador = ?";
    $check_stmt = $mysqli->prepare($check_sql);
    $check_stmt->bind_param("i", $user_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['status'] === 'desativado') {
        echo "<p>Conta já está desativada.</p>";
        session_destroy();
        header("Location: telas/usuarios/login.php?msg=conta_ja_desativada");
        exit();
    }

    // Atualizar o status para desativado
    $sql = "UPDATE DOADOR SET status = 'desativado' WHERE id_doador = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if (!$stmt->execute()) {
        echo "Erro no MySQL: " . $mysqli->error;
        exit();
    }

    session_destroy();
    header("Location: telas/usuarios/login.php?msg=conta_desativada");
    exit();
} catch (Exception $e) {
    echo "<p>Erro ao processar a solicitação: " . $e->getMessage() . "</p>";
} finally {
    $stmt->close();
    $mysqli->close();
}