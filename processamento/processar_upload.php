<?php
// processamento/processar_upload.php

include_once('../classes/documentos.class.php');
include_once('../sessao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $cod_pessoa = $_SESSION['cod_pessoa'];
    $cod_tipo_documento = $_POST['cod_tipo_documento'];

    $allowed_types = array(
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'application/pdf' => 'pdf'
    );

    $file_type = $_FILES['file']['type'];

    if (array_key_exists($file_type, $allowed_types)) {
        $file_extension = $allowed_types[$file_type];
        $new_file_name = uniqid() . '.' . $file_extension;
        $targetDirectory = "../uploads/";
        $targetFile = $targetDirectory . $new_file_name;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            $documento = new Documentos();
            $documento->setCodPessoa($cod_pessoa);
            $documento->setCodTipoDocumento($cod_tipo_documento);
            $documento->setVchDocumento($new_file_name);
            $documento->setStatus('pendente');

            if ($documento->inserirDocumento()) {
                echo json_encode(['success' => true, 'filepath' => $targetFile]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao salvar no banco de dados.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao mover o arquivo.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Tipo de arquivo não permitido.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Nenhum arquivo foi enviado.']);
}
?>
