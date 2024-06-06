<?php
include_once("../classes/login.class.php");

if(!isset($_SESSION)){
    session_start();
}
$email = $_POST['login'];
$senha = $_POST['senha'];

$login = new Login();

if ($login->login($email, $senha)) {
    if (isset($_SESSION["user_session"])) {
        if ($_SESSION["nivel"] == 2) {
            header('Location: ../pessoa_cadastrada.php');
        } else {
            header('Location: ../pagina_usuario.php');
        }
    } else {
        header('Location: ../index.php?teste');
    }
} else {
    header('Location: ../index.php?msg=2');
}
