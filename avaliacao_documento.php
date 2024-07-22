<?php
include_once("classes/documentos.class.php");
include_once('classes/obs.class.php');
include_once("sessao.php");


// Função para validar o token
function validar_token($token) {
    $tokens = json_decode(file_get_contents('tokens.json'), true);
    if (isset($tokens[$token]) && !$tokens[$token]['used']) {
        // Marca o token como usado
        $tokens[$token]['used'] = true;
        file_put_contents('tokens.json', json_encode($tokens, JSON_PRETTY_PRINT));
        return true;
    }
    return false;
}

// Verifica se o token foi enviado
if (isset($_POST['token'])) {
    $token = $_POST['token'];
    if (validar_token($token)) {
        $_SESSION['authorized'] = true;
        header('Location: pagina_autorizada.php');
        exit();
    } else {
        $erro = 'Token inválido ou já utilizado.';
    }
}

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('images/background_login2.webp') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 30px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
        .btn-primary, .btn-success, .btn-warning {
            border-radius: 20px;
            margin: 5px;
        }
        .btn-block {
            display: block;
            width: 100%;
        }
        .document-preview {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
        .navbar {
            background-color: #343a40;
            color: white;
        }
        .navbar .navbar-brand, .navbar-nav .nav-link {
            color: white;
        }
        .navbar .nav-link:hover {
            color: #007bff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#"><i class="fas fa-home"></i> Início</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-cog"></i> Configurações</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="processamento/logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
                </li>
            </ul>
        </div>
    </nav>

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
        <table class="table table-striped">
            <tbody>
                <?php
                while ($row_documento = $doc->fetch(PDO::FETCH_ASSOC)) {
                    $result_obs = $obs->exibirobsPorDocumento($cod_pessoa, $row_documento['cod_tipo_documento']);
                    $num_linha = $result_obs->rowCount();
                ?>
                <tr>
                    <td style="vertical-align: middle">
                        <?php echo "<a target='_blank' href='uploads/".$row_documento["vch_documento"]."'><img src='uploads/".$row_documento["vch_documento"]."' alt='Abrir Documento' class='document-preview'></a>"?>
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
                        <form action="processamento/processar_documentos.php" method="POST" style="display:inline;">
                            <input type="hidden" name="MM_action" value="2">
                            <input type="hidden" name="cod_pessoa" value="<?php echo $row_documento['cod_pessoa']; ?>">
                            <input type="hidden" name="cod_tipo_documento" value="<?php echo $row_documento['cod_tipo_documento']; ?>">
                            <input type="hidden" name="status" value="<?php echo $row_documento['status'] == 0 || $row_documento['status'] == 2 ? '1' : '0'; ?>">
                            <input type="submit" class="btn btn-block <?php echo $row_documento['status'] == 0 || $row_documento['status'] == 2 ? 'btn-success' : 'btn-warning'; ?>" value="<?php echo $row_documento['status'] == 0 || $row_documento['status'] == 2 ? 'Aprovar' : 'Desaprovar'; ?>">
                        </form>
                        <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#obsModal" data-cod_pessoa="<?php echo $cod_pessoa ?>" data-cod_tipo_documento="<?php echo $row_documento['cod_tipo_documento']; ?>">Escrever Observação</button>
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
                    <form id="obsForm" action="processamento/processar_documentos.php" method="POST">
                        <input type="hidden" name="MM_action" value="3">
                        <input type="hidden" name="cod_pessoa" id="modal_cod_pessoa">
                        <input type="hidden" name="cod_tipo_documento" id="modal_cod_tipo_documento">
                        <label for="obs">Nova observação:</label>
                        <textarea name="obs" id="obs" cols="30" rows="4" class="form-control mb-2"></textarea>
                        <button type="submit" class="btn btn-primary btn-block">Enviar observação</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts Extras -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
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
