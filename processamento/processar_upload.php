<?php

include_once('../classes/documentos.class.php');
include_once('../sessao.php');

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


