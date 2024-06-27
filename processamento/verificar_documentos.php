<?php
include_once('../classes/documentos.class.php');

if (!isset($_SESSION)) {
    session_start();
}

$cod_pessoa = $_POST['cod_pessoa'];
$documentos = new Documentos();

$documentos_necessarios = [1, 2, 3, 4, 5];
$documentos_enviados = [];

foreach ($documentos_necessarios as $tipo_documento) {
    $resultado = $documentos->buscarDocumentoPessoa($cod_pessoa, $tipo_documento);
    if ($resultado && $resultado->rowCount() > 0) {
        $documentos_enviados[] = $tipo_documento;
    }
}

$response = [
    'allDocuments' => count($documentos_enviados) === count($documentos_necessarios)
];

echo json_encode($response);
?>
