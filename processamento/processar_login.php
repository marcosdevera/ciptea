<?php
include_once("../classes/login.class.php");

if (!isset($_SESSION)) {
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
            header('Location: ../cadastro_inicialUP.php');
        }
    } else {
        header('Location: ../index.php?error=1');
    }
} else {
    header('Location: ../index.php?error=1');
}
?>
