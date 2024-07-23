<?php
include_once("../classes/login.class.php");

if (!isset($_SESSION)) {
    session_start();
}

// Verifica se os dados de login foram fornecidos
$email = isset($_POST['login']) ? $_POST['login'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

// Verifica se o email e a senha não estão vazios
if (empty($email) || empty($senha)) {
    header('Location: ../index.php?error=empty_fields');
    exit();
}

$login = new Login();
$loginSuccess = $login->login($email, $senha);

// Verifica se o login foi bem-sucedido
if ($loginSuccess) {
    // Verifica se a sessão do usuário foi definida
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
