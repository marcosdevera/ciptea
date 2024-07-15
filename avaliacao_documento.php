<?php
include_once("classes/documentos.class.php");
include_once('classes/obs.class.php');
include_once("sessao.php");

$d = new Documentos();

$cod_pessoa_decode = urldecode($_GET['cod']);
$cod_pessoa = base64_decode($cod_pessoa_decode);

// Obter a identificação e nome da pessoa
$identificacao = $d->exibirDocumentos($cod_pessoa);
$nome_pessoa = $identificacao->fetch(PDO::FETCH_ASSOC);

// Obter documentos da pessoa
$doc = $d->exibirDocumentos($cod_pessoa);

$obs = new Obs();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Avaliação de documentos</title>
    <!-- Bootstrap e dependências -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/formValidation.css">
    <link rel="stylesheet" href="css/loading.css">
    <link rel="stylesheet" href="css/bootstrap-combobox.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <h2>ABA DE VALIDAÇÃO</h2>
                <?php if ($nome_pessoa): ?>
                    <h4>Requerente: <?php echo $nome_pessoa['vch_nome'] ?></h4>
                    <h4>CPF: <?php echo $nome_pessoa['vch_cpf'] ?></h4>
                <?php else: ?>
                    <h4>Requerente: Informação não disponível</h4>
                    <h4>CPF: Informação não disponível</h4>
                <?php endif; ?>
            </div>
            <div class="col-sm-2 pull-right">
                <a href="pessoa_cadastrada.php" class="btn btn-primary pull-right">Voltar</a>
            </div>
        </div>
        <table class="table">
            <tbody>
                <?php
                while ($row_documento = $doc->fetch(PDO::FETCH_ASSOC)) {
                    $result_obs = $obs->exibirobsPorDocumento($cod_pessoa, $row_documento['cod_tipo_documento']);
                    $num_linha = $result_obs->rowCount();
                ?>
                <tr>
                    <td style="vertical-align: middle">
                        <?php echo "<a target='_blank' href='uploads/".$row_documento["vch_documento"]."'><img src='images/document.png' alt='Abrir Documento'></a>"?>
                    </td>
                    <td>
                        <h4>Tipo da documentação</h4>
                        <?php 
                        switch ($row_documento["cod_tipo_documento"]) {
                            case 1:
                                echo "Foto de identificação";
                                break;
                            case 2:
                                echo "Laudo médico";
                                break;
                            case 3:
                                echo "Comprovante de residência";
                                break;
                            case 4:
                                echo "Documento com foto";
                                break;
                            default:
                                echo "Requerimento";
                        }
                        ?>
                    </td>
                    <td class="text-center">
                        <h4>Data de inserção</h4>
                        <?php echo $row_documento["sdt_insercao"] != "" ? date("d/m/Y", strtotime($row_documento["sdt_insercao"])) : ""?>
                    </td>
                    <td class="text-center">
                        <h4>Status</h4>
                        <strong>
                            <?php 
                            echo $row_documento["status"] == 0 ? "Aguardando validação" : ($row_documento["status"] == 1 ? "Aprovado" : "Recusado");
                            ?>
                        </strong>
                    </td>
                    <td class="text-center">
                        <h4>Ação</h4>
                        <form action="processamento/processar_usuario.php" method="POST" style="display:inline;">
                            <input type="hidden" name="MM_action" value="2">
                            <input type="hidden" name="cod_pessoa" value="<?php echo $row_documento['cod_pessoa']; ?>">
                            <input type="hidden" name="cod_tipo_documento" value="<?php echo $row_documento['cod_tipo_documento']; ?>">
                            <input type="hidden" name="status" value="<?php echo $row_documento['status'] == 0 || $row_documento['status'] == 2 ? '1' : '0'; ?>">
                            <input type="submit" class="btn <?php echo $row_documento['status'] == 0 || $row_documento['status'] == 2 ? 'btn-success' : 'btn-warning'; ?>" value="<?php echo $row_documento['status'] == 0 || $row_documento['status'] == 2 ? 'Aprovar' : 'Desaprovar'; ?>">
                        </form>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#obsModal" data-cod_pessoa="<?php echo $cod_pessoa ?>" data-cod_tipo_documento="<?php echo $row_documento['cod_tipo_documento']; ?>">Escrever Observação</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="obsModal" tabindex="-1" role="dialog" aria-labelledby="obsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="obsModalLabel">Escrever Observação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="obsForm" action="processamento/processar_usuario.php" method="POST">
                        <input type="hidden" name="MM_action" value="3">
                        <input type="hidden" name="cod_pessoa" id="modal_cod_pessoa">
                        <input type="hidden" name="cod_tipo_documento" id="modal_cod_tipo_documento">
                        <label for="obs">Nova observação:</label>
                        <textarea name="obs" id="obs" cols="30" rows="4" class="form-control mb-2"></textarea>
                        <button type="submit" class="btn btn-primary">Enviar observação</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts Extras -->
    <?php include("scripts.php"); ?>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $('#obsModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var cod_pessoa = button.data('cod_pessoa');
            var cod_tipo_documento = button.data('cod_tipo_documento');
            
            var modal = $(this);
            modal.find('#modal_cod_pessoa').val(cod_pessoa);
            modal.find('#modal_cod_tipo_documento').val(cod_tipo_documento);
        });
    </script>
</body>
</html>
