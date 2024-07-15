<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../classes/documentos.class.php');
include_once('../classes/obs.class.php');

try {
    $obs = new Obs();
    $documentos = new Documentos();

    // Capturar e processar a observação antes de qualquer outra operação
    if (isset($_POST['obs']) && isset($_POST['cod_pessoa'])) {
        $obs->setCodPessoa($_POST['cod_pessoa']);
        $obs->setObs($_POST['obs']);
        $obs->setCodTipoDocumento($_POST['cod_tipo_documento']); // Certifique-se de que está capturando cod_tipo_documento

        // Remover observações antigas antes de inserir a nova
        $obs->removerObsAntigas($_POST['cod_pessoa'], $_POST['cod_tipo_documento']);
        
        $obs->inserirObs();

        // Atualizar o status do documento para "recusado" ao adicionar observação
        $documentos->setCodPessoa($_POST['cod_pessoa']);
        $documentos->setCodTipoDocumento($_POST['cod_tipo_documento']);
        $documentos->setStatus(2); // Status "recusado"
        $documentos->validarDocumento(2); // Atualiza o status para "recusado"
        exit();
    }

    // Atualizar o status do documento se houver mudança de status
    if (isset($_POST['status']) && isset($_POST['cod_pessoa']) && isset($_POST['cod_tipo_documento'])) {
        $documentos->setCodPessoa($_POST['cod_pessoa']);
        $documentos->setCodTipoDocumento($_POST['cod_tipo_documento']);
        $documentos->setStatus($_POST['status']);
        $documentos->validarDocumento($_POST['status']);
        
        // Só mostrar mensagem de observação se o status não for "aprovado"
        if ($_POST['status'] != 1) { // Assumindo que 1 é o status "aprovado"
            echo "Observação adicionada.";
        }
    }

} catch (Exception $e) {
    echo "Erro ao realizar a operação: " . $e->getMessage();
}
?>
