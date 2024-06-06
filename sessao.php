<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    ini_set("display_errors", 1);
    error_reporting(E_ALL);

    // define("Sair", "Arquivo de sair sistema");

    if(!isset($_SESSION['user_session']) || ($_SESSION['user_session'] == "")){
        session_destroy();
        if(!isset($_SESSION)){
            session_start();
        }
        $_SESSION['resposta'] = "Você não está logado no sistema!";
        header("location: index.php");
        die();
    }
?>