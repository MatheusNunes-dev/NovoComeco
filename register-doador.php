<?php
session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera as informações do formulário
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $cpf = $_POST['cpf'];
    $cep = $_POST['cep'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];

    // Aqui você pode inserir os dados no banco de dados (não mostrado neste exemplo)

    // Após o cadastro bem-sucedido, cria uma variável de sessão para identificar o doador
    $_SESSION['is_doador'] = true;

    // Redireciona para a página restrita do doador
    header('Location: telas/doador/configuracoes-doador.php');
    exit;
}
