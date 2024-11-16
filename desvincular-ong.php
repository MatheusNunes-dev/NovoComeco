<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/db.php'; // Verifique o caminho correto

// Verificar se o usuário está logado e é ONG
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['user_tipo'] !== 'ong') {
    header("Location: telas/usuarios/usu-login.php");
    exit();
}

$user_id = (int) $_SESSION['user_id']; // ID da ONG logada

try {
    // Verificar o status atual da ONG
    $check_sql = "SELECT status FROM ONG WHERE id_ong = ?";
    $check_stmt = $mysqli->prepare($check_sql);
    if (!$check_stmt) {
        throw new Exception("Erro ao preparar a consulta: " . $mysqli->error);
    }
    $check_stmt->bind_param("i", $user_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['status'] === 'desativado') {
        session_destroy();
        header("Location: telas/usuarios/usu-login.php?msg=ong_ja_desativada");
        exit();
    }

    // Atualizar o status para desativado
    try {
        // Atualizar o status para 'inativo' (valor permitido)
        $sql = "UPDATE ONG SET status = 'inativo' WHERE id_ong = ?";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            throw new Exception("Erro ao preparar a consulta: " . $mysqli->error);
        }
        $stmt->bind_param("i", $user_id);

        if (!$stmt->execute()) {
            throw new Exception("Erro ao executar a consulta: " . $stmt->error);
        }

        // Destruir a sessão e redirecionar
        session_destroy();
        echo "<script>
            alert('Sua ONG foi desativada com sucesso.');
            window.location.href = 'telas/usuarios/usu-login.php';
        </script>";
        exit();
    } catch (Exception $e) {
        echo "<script>
            alert('Erro ao processar a solicitação: " . $e->getMessage() . "');
            window.location.href = 'telas/ong/configuracoes-ong.php';
        </script>";
    }



    // Destruir a sessão e redirecionar para login
    session_destroy();
    header("Location: telas/usuarios/usu-login.php?msg=ong_desvinculada");
    exit();
} catch (Exception $e) {
    echo "<script>
        alert('Erro ao processar a solicitação: " . addslashes($e->getMessage()) . "');
        window.location.href = 'telas/ong/configuracoes-ong.php';
    </script>";
} finally {
    if (isset($check_stmt)) $check_stmt->close();
    if (isset($stmt)) $stmt->close();
    if (isset($mysqli)) $mysqli->close();
}
