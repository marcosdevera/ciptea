<?php
include_once('../classes/pessoa.class.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_POST['cod_pessoa'])) {
    echo 'cod_pessoa não fornecido.';
    exit;
}

$cod_pessoa = $_POST['cod_pessoa'];

$p = new Pessoa();

if ($p->apagarPessoa($cod_pessoa)) {
    $mensagem = "Cadastro apagado com sucesso.";
    $tipo_mensagem = "success";
} else {
    $mensagem = "Erro ao apagar cadastro.";
    $tipo_mensagem = "danger";
}

$_SESSION['mensagem'] = $mensagem;
$_SESSION['tipo_mensagem'] = $tipo_mensagem;

header("Location: ../pessoa_cadastrada.php");
exit();
?>
