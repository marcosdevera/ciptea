<?php
include_once("../classes/login.class.php");

if (!isset($_SESSION)) {
    session_start();
}

$email = $_POST['login'];
$senha = $_POST['senha'];

$login = new Login();
$loginSuccess = $login->login($email, $senha);

if ($loginSuccess) {
    if (isset($_SESSION["user_session"])) {
        if ($_SESSION["nivel"] == 2) {
            header('Location: ../pessoa_cadastrada.php');
        } else {
            header('Location: ../cadastro_inicialUP.php');
        }
    } else {
        // Depuração: Verificar se a sessão está configurada corretamente
        error_log("Sessão 'user_session' não está definida após login bem-sucedido.");
        header('Location: ../index.php?error=session_not_set');
    }
} else {
    // Depuração: Login falhou
    error_log("Login falhou para o email: $email");
    header('Location: ../index.php?error=invalid_credentials');
}
?>
