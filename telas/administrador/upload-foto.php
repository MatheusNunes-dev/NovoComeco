<?php
session_start();
require('../../db.php'); // Inclui a conexão com o banco

// Verifica se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: /telas/usuarios/login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // ID do administrador logado

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $target_dir = "../../uploads/";
    $file_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar o tipo do arquivo
    $valid_extensions = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $valid_extensions)) {
        echo "<script>alert('Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.');</script>";
    } else {
        // Mover o arquivo para a pasta de destino
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Atualizar a imagem no banco de dados
            $sql = "UPDATE administrador SET foto = ? WHERE id_administrador = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("si", $file_name, $user_id);

            if ($stmt->execute()) {
                echo "<script>
                    alert('Foto atualizada com sucesso!');
                    window.location.href = 'configuracoes-administrador.php';
                </script>";
            } else {
                echo "<script>alert('Erro ao salvar a foto no banco de dados.');</script>";
            }
        } else {
            echo "<script>alert('Erro ao fazer upload do arquivo.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Começo - Configurações</title>
    <link rel="shortcut icon" href="../../assets/logo.png" type="Alegrinho">
    <link rel="stylesheet" href="../../css/todos-global.css">
</head>
<style>
    .upload-container {
        width: 50%;
        margin: 50px auto;
        padding: 20px;
        border: 2px dashed #ccc;
        text-align: center;
        border-radius: 10px;
        background-color: #f9f9f9;
    }

    .upload-container.dragover {
        border-color: #000;
        background-color: #e0e0e0;
    }

    .upload-container p {
        margin: 10px 0;
        font-size: 18px;
        color: #555;
    }

    .upload-container input[type="file"] {
        display: none;
    }

    .upload-container label {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007BFF;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
</head>

<header>
    <nav class="navbar nav-lg-screen" id="navbar">
        <button class="btn-icon-header" onclick="toggleSideBar()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
            </svg>
        </button>
        <div>
            <img class="img-logo" id="logo" src="../../assets/logo.png" alt="Logo">
        </div>
        <div class="nav-links" id="nav-links">
            <ul>
                <li>
                    <button class="btn-icon-header" onclick="toggleSideBar()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-x" viewBox="0 0 16 16">
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </button>
                </li>
                <li class="nav-link"><a href="../../telas/usuarios/index.php">HOME</a></li>
                <li class="nav-link"><a href="../../telas/usuarios/pagina-quero-doar.php">ONG'S</a></li>
                <li class="nav-link"><a href="../../telas/usuarios/sobre.php">SOBRE</a></li>
                <li class="nav-link"><a href="../../telas/usuarios/contato.php">CONTATO</a></li>
            </ul>
        </div>
        <div class="user">
            <a href="configuracoes-administrador.php">
                <img class="img-user" src="../../assets/user.png" alt="Usuário">
            </a>
        </div>
    </nav>
</header>

<body>
    <div class="upload-container" id="drop-zone">
        <form action="upload-foto.php" method="POST" enctype="multipart/form-data">
            <p>Arraste e solte uma imagem aqui ou clique para selecionar.</p>
            <input type="file" name="image" id="image-input" accept="image/*">
            <label for="image-input">Selecionar imagem</label>
            <button type="submit" style="margin-top: 20px;">Enviar Foto</button>
        </form>
    </div>

    <footer>
        <div class="footer">
            <div class="img-footer-start">
                <img class="boneco-footer img-footer" src="../../assets/img-footer.png" alt="Boneco do rodapé">
            </div>
            <div class="socias">
                <div class="icons-col-1">
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/google.png" alt="Google">
                        <p>novocomeço@gmail.com</p>
                    </div>
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/instagram.png" alt="Instagram">
                        <p>@novocomeço</p>
                    </div>
                </div>
                <div class="icons-col-2">
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/whatsapp.png" alt="Whatsapp">
                        <p>(41) 99997-6767</p>
                    </div>
                    <div class="social-footer">
                        <img class="icon-footer" src="../../assets/facebook.png" alt="Facebook">
                        <p>@novocomeco</p>
                    </div>
                </div>
            </div>
            <div class="img-footer-end">
                <img class="boneco-footer img-footer" src="../../assets/img-footer.png" alt="Boneco do rodapé">
            </div>
        </div>
    </footer>

    <script>
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('image-input');

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('dragover');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('dragover');
            if (e.dataTransfer.files.length > 0) {
                fileInput.files = e.dataTransfer.files;
            }
        });

        dropZone.addEventListener('click', () => {
            fileInput.click();
        });
    </script>
</body>

</html>