<?php
session_start();

// Ajuste o caminho para o arquivo db.php
require(__DIR__ . '/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $mensagem = trim($_POST['mensagem']);

    // Valida os dados do formulário
    if (!empty($nome) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($mensagem)) {
        // Prepara a consulta para inserir os dados na tabela CONTATO
        $sql = "INSERT INTO CONTATO (nome, email, mensagem) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $nome, $email, $mensagem);

            if ($stmt->execute()) {
                echo "<script>alert('Mensagem enviada com sucesso!');</script>";
            } else {
                echo "<script>alert('Erro ao enviar a mensagem. Tente novamente mais tarde.');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Erro ao preparar a consulta.');</script>";
        }
    } else {
        echo "<script>alert('Por favor, preencha todos os campos corretamente.');</script>";
    }

    // Redireciona para a página de contato após o envio
    header("Location: /telas/usuarios/usu-contato.php");
    exit();
} else {
    // Redireciona caso o acesso ao arquivo não seja via POST
    header("Location: /telas/usuarios/usu-contato.php");
    exit();
}
