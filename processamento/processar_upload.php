<?php

include_once('../classes/documentos.class.php');
include_once('../sessao.php');

$documentos = new Documentos();

$cod_pessoa = $_SESSION['cod_pessoa'];

if (isset($_POST["cod_tipo_documento"])) {
    $documentos->setCodTipoDocumento($_POST["cod_tipo_documento"]);
}

if (isset($_POST["cod_pessoa"]) && isset($_POST["cod_tipo_documento"])) {
    $documentos->setCodPessoa($_POST["cod_pessoa"]);
    $documentos->setVchDocumento($newFileName); // Certifique-se de definir $newFileName
    $documentos->setStatus(0); // Certifique-se de definir um status válido
}

// Verifica se está set cod_pessoa e cod_tipo_documento = 5 para o requerimento 
if (isset($_POST['cod_pessoa']) && isset($_POST['cod_tipo_documento']) && $_POST['cod_tipo_documento'] == 5) {
    $documentos->setStatus(0);
    $documentos->atualizarDocumento();
} else {
    $documentos->inserirDocumento($cod_pessoa, $_POST["cod_tipo_documento"]);
}


try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['requerimento_upload'])) {
        // Verifica se o diretório de destino existe e cria se não existir
        $targetDirectory = "../uploads/";
        // if (!is_dir($targetDirectory)) {
        //     if (!mkdir($targetDirectory, 0777, true)) {
        //         throw new Exception("Falha ao criar diretório: $targetDirectory");
        //     }
        // }

        // Gera um nome de arquivo aleatório de 30 caracteres
        $randomFileName = bin2hex(random_bytes(15));
        $fileExtension = pathinfo($_FILES['requerimento_upload']['name'], PATHINFO_EXTENSION);
        $newFileName = $randomFileName . '.' . $fileExtension;

        $targetFile = $targetDirectory . $newFileName;

        if (move_uploaded_file($_FILES['requerimento_upload']['tmp_name'], $targetFile)) {
            echo "Arquivo " . $newFileName . " foi enviado com sucesso.";
        } else {
            throw new Exception("Erro ao mover o arquivo para o diretório de destino.");
        }
    } else {
        throw new Exception("Nenhum arquivo foi enviado.");
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>


