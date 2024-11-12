<?php
session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera as informações do formulário
    $nome = $_POST['nome'];
    $cnpj = $_POST['cnpj'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cep = $_POST['cep'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];

    // Aqui você pode inserir os dados no banco de dados (não mostrado neste exemplo)

    // Após o cadastro bem-sucedido, cria uma variável de sessão para identificar a ONG
    $_SESSION['is_ong'] = true;

    // Redireciona para a página restrita da ONG
    header('Location: telas/ong/configuracoes-ong.php');
    exit;
}
