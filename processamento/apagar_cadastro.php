<?php
include_once('classes/pessoa.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cod_pessoa = $_POST['cod_pessoa'];
    $p = new Pessoa();
    if ($p->apagarPessoa($cod_pessoa)) {
        header('Location: index.php?msg=1');
    } else {
        header('Location: index.php?msg=2');
    }
} else {
    header('Location: index.php');
}
?>
