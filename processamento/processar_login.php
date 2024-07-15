<?php
include_once("../classes/login.class.php");

if (!isset($_SESSION)) {
    session_start();
}

$email = $_POST['login'] ?? '';
$senha = $_POST['senha'] ?? '';

$login = new Login();
$loginSuccess = $login->login($email, $senha);

if ($loginSuccess) {
    if (isset($_SESSION["user_session"])) {
        if ($_SESSION["nivel"] == 2) {
            header('Location: ../pessoa_cadastrada.php');
        } else {
            header('Location: ../cadastro_inicialUP.php');
        }
        exit(); // Garantir que o script pare após o redirecionamento
    } else {
        header('Location: ../index.php?error=session_not_set');
        exit();
    }
} else {
    header('Location: ../index.php?error=invalid_credentials');
    exit();
}
?>
