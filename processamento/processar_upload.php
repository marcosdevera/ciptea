<?php
include_once('../classes/documentos.class.php');
include_once('../sessao.php');

$documentos = new Documentos();

if (!isset($_SESSION)) {
    session_start();
}

$cod_pessoa = $_SESSION['cod_pessoa'];
$cod_tipo_documento = $_POST['cod_tipo_documento'];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
        // Verifica se o diretório de destino existe e cria se não existir
        $targetDirectory = "../uploads/";
        if (!is_dir($targetDirectory)) {
            if (!mkdir($targetDirectory, 0777, true)) {
                throw new Exception("Falha ao criar diretório: $targetDirectory");
            }
        }

        // Gera um nome de arquivo aleatório de 30 caracteres
        $randomFileName = bin2hex(random_bytes(15));
        $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $newFileName = $randomFileName . '.' . $fileExtension;

        $targetFile = $targetDirectory . $newFileName;

        // Configura o nome do arquivo e o status
        $documentos->setVchDocumento('../uploads/'.$newFileName);
        $documentos->setStatus(0);
        $documentos->setCodPessoa($cod_pessoa);
        $documentos->setCodTipoDocumento($cod_tipo_documento);

        // Verifica se o documento já existe
        $resultado = $documentos->buscarDocumentoPessoa($cod_pessoa, $cod_tipo_documento);

        if ($resultado && $resultado->rowCount() > 0) {
            // Atualiza o documento existente
            $documentos->atualizarDocumento();
        } else {
            // Insere um novo documento
            $documentos->inserirDocumento($cod_pessoa, $cod_tipo_documento);
        }

        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            echo json_encode(['success' => true, 'message' => 'Arquivo enviado com sucesso.', 'fileName' => $newFileName]);
        } else {
            throw new Exception("Erro ao mover o arquivo para o diretório de destino.");
        }
    } else {
        throw new Exception("Nenhum arquivo foi enviado.");
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>