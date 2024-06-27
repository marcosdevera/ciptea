<?php
include_once('../classes/documentos.class.php');
include_once('../sessao.php');

$documentos = new Documentos();

if (!isset($_SESSION)) {
    session_start();
}

$cod_pessoa = $_SESSION['cod_pessoa'];

// Verifica se o POST contém 'cod_tipo_documento' e 'cod_pessoa'
if (isset($_POST["cod_tipo_documento"]) && isset($_POST["cod_pessoa"])) {
    $cod_tipo_documento = $_POST["cod_tipo_documento"];
    $documentos->setCodTipoDocumento($cod_tipo_documento);
    $documentos->setCodPessoa($cod_pessoa);
}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['requerimento_upload'])) {
        // Verifica se o diretório de destino existe e cria se não existir
        $targetDirectory = "../uploads/";
        if (!is_dir($targetDirectory)) {
            if (!mkdir($targetDirectory, 0777, true)) {
                throw new Exception("Falha ao criar diretório: $targetDirectory");
            }
        }

        // Gera um nome de arquivo aleatório de 30 caracteres
        $randomFileName = bin2hex(random_bytes(15));
        $fileExtension = pathinfo($_FILES['requerimento_upload']['name'], PATHINFO_EXTENSION);
        $newFileName = $randomFileName . '.' . $fileExtension;

        $targetFile = $targetDirectory . $newFileName;

        if (move_uploaded_file($_FILES['requerimento_upload']['tmp_name'], $targetFile)) {
            // Define o nome do arquivo no objeto $documentos
            $documentos->setVchDocumento($newFileName);
            
            // Define o status
            $documentos->setStatus(0);

            // Verifica se o tipo de documento é 5 (Requerimento)
            if ($cod_tipo_documento == 5) {
                $documentos->atualizarDocumento();
            } else {
                $documentos->inserirDocumento($cod_pessoa, $cod_tipo_documento);
            }

            echo json_encode(['success' => true, 'message' => "Arquivo " . $newFileName . " foi enviado com sucesso.", 'filepath' => $targetFile]);
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
