<?php
include_once("../classes/login.class.php");

if (!isset($_SESSION)) {
    session_start();
}

$email = $_POST['login'] ?? '';
$senha = $_POST['senha'] ?? '';

$login = new Login();

if ($login->login($email, $senha)) {
    // Obter informações adicionais do usuário, se necessário
    $user = $login->getUser($email);
    if ($user) {
        // Exemplo de verificação adicional baseada no perfil do usuário
        if ($user['perfil'] == 'admin') {
            header('Location: ../admin_dashboard.php');
        } else {
            header('Location: ../cadastro_inicialUP.php');
        }
        exit(); // Garantir que o script pare após o redirecionamento
    } else {
        header('Location: ../index.php?error=1');
        exit();
    }
} else {
    header('Location: ../index.php?error=1');
    exit();
}
?>
