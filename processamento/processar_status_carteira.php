<?php
include_once('../classes/pessoa.class.php');

if (!isset($_POST['cod_pessoa'])) {
    echo json_encode(['success' => false, 'message' => 'Código da pessoa não fornecido.']);
    exit;
}

$cod_pessoa = $_POST['cod_pessoa'];

try {
    $pessoa = new Pessoa();
    $pessoa->atualizarStatusCarteirinha($cod_pessoa);
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
