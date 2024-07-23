<?php
include_once("../classes/login.class.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
    $login = new Login();
    $result = $login->verificarCPF($cpf);
    echo json_encode($result);
}
?>
