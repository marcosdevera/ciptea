<?php
include_once('../classes/documentos.class.php');
include_once('../classes/obs.class.php');

if (!isset($_SESSION)) {
    session_start();
}

$action = $_POST['action'];
$cod_pessoa = $_POST['cod_pessoa'];

if ($action == 'verify_documents') {
    $documentos = new Documentos();
    $documentos_necessarios = [1, 2, 3, 4, 5];
    $documentos_enviados = [];

    foreach ($documentos_necessarios as $tipo_documento) {
        $resultado = $documentos->buscarDocumentoAutorizadosPessoa($cod_pessoa, $tipo_documento);
        if ($resultado && $resultado->rowCount() > 0) {
            $documentos_enviados[] = $tipo_documento;
        }
    }

    $response = [
        'allDocuments' => count($documentos_enviados) === count($documentos_necessarios)
    ];

    echo json_encode($response);
} elseif ($action == 'fetch_observations') {
    $cod_tipo_documento = $_POST['cod_tipo_documento'];
    $obs = new Obs();
    $result_obs = $obs->exibirobs($cod_pessoa, $cod_tipo_documento);
    $observacoes = "";

    if ($result_obs->rowCount() > 0) {
        while ($row_obs = $result_obs->fetch(PDO::FETCH_ASSOC)) {
            $observacoes .= date("d/m/Y", strtotime($row_obs["sdt_criacao"])) . " - " . $row_obs["obs"] . "\n";
        }
    }

    echo $observacoes;
}
?>
