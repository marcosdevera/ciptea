<?php
include_once("../classes/login.class.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = isset($_POST['login']) ? $_POST['login'] : '';
    $loginClass = new Login();
    $result = $loginClass->verificarLogin($login);
    echo $result;
}
?>
