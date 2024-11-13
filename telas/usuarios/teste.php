<?php
include('../../db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletando os dados do formulário
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
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Aqui você pode validar os dados, por exemplo, checar se as senhas coincidem
    if ($password !== $confirmPassword) {
        echo "As senhas não coincidem.";
    } else {
        // // Dados fixos para inserção sem criptografia de senha
        $sql_code = "INSERT INTO DOADOR(nome, email, senha, telefone, cpf, data_cadastro, end_rua, end_numero, end_bairro, end_cidade, end_estado, end_complemento) 
                    VALUES ('$name', '$email', '$password', '$phone', '$cpf', NOW(), '$rua', '$numero', '$bairro', '$cidade', '$estado', '$complemento')";

        // Executa o comando no banco de dados
        if ($mysqli->query($sql_code) === TRUE) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar: " . $mysqli->error;
        }

    }
}