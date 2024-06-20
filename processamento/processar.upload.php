<?php
// processamento/processar_upload.php

include_once('../classes/documentos.class.php');
include_once('../sessao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cod_pessoa = $_SESSION['cod_pessoa'];
    $cod_tipo_documento = $_POST['cod_tipo_documento'];

    $allowed_types = array(
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'application/pdf' => 'pdf'
    );

    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_name = $_FILES['file']['name'];
        $file_type = $_FILES['file']['type'];

        if (array_key_exists($file_type, $allowed_types)) {
            $file_extension = $allowed_types[$file_type];
            $new_file_name = uniqid() . '.' . $file_extension;
            $upload_dir = '../uploads/';
            $upload_file = $upload_dir . $new_file_name;

            if (move_uploaded_file($file_tmp, $upload_file)) {
                $documento = new Documentos();
                $documento->setCodPessoa($cod_pessoa);
                $documento->setCodTipoDocumento($cod_tipo_documento);
                $documento->setVchDocumento($new_file_name);
                $documento->setStatus('pendente');

                if ($documento->inserirDocumento()) {
                    echo json_encode(['success' => true, 'filepath' => $upload_file]);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false]);
            }
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
