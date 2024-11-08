<?php
    if (!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION[id])){
        die("Você nao pode acessar essa página sem se logar.<p><a href=\"../html/cadastrar-ong.html\"Entrar</p>")
    }

?>