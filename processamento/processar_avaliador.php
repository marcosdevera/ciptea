<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../classes/usuario.class.php');
include_once('../classes/avaliador.class.php');

$avaliador = new Avaliador();

if(isset($_POST['vch_avaliador'])){
    $avaliador->setVchAvaliador($_POST['vch_avaliador']);
}

if(isset($_POST['vch_cpf_avaliador'])){
    $cpf_sem_pontos = str_replace(array(".", "-"), "", $_POST['vch_cpf_avaliador']);
    $avaliador->setVchCpfAvaliador($cpf_sem_pontos);
}

$usuario = new Usuario();

if(isset($_POST['vch_login'])){
   $usuario->setVch_login($_POST['vch_login']);
}

if(isset($_POST['vch_senha'])){
    $usuario->setVch_senha(password_hash($_POST['vch_senha'], PASSWORD_DEFAULT));
}

$usuario->setInt_perfil(2);
$usuario->setInt_situacao(1);

if ($_POST['MM_action'] == 1) {
$usuario->inserirUsuarioAvaliador($avaliador);
}