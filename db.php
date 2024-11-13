<?php
$servername = "novocomeco.mysql.database.azure.com";  // endereço do servidor no Azure
$username = "novocomeco@novocomeco";                 // nome de usuário completo (usuário@servidor)
$password = "novocomeco#2024";                       // senha do MySQL
$dbname = "NovoComeco";                              // nome do banco de dados
$port = 3306;                                        // porta padrão do MySQL

// Caminho para o certificado SSL da CA (normalmente é baixado do Azure)
$ca_cert_path = "BaltimoreCyberTrustRoot.crt.pem";

// Inicializa a conexão com SSL
$con = mysqli_init();
mysqli_ssl_set($con, NULL, NULL, $ca_cert_path, NULL, NULL);

// Conecta ao banco de dados com SSL
if (!mysqli_real_connect($con, $servername, $username, $password, $dbname, $port, NULL, MYSQLI_CLIENT_SSL)) {
    die("Falha na conexão: " . mysqli_connect_error());
}

echo "Conexão bem-sucedida com SSL!";

// Fechar a conexão quando não for mais necessário
mysqli_close($con);
?>