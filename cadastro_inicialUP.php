<?php
include_once('sessao.php');
include_once('classes/documentos.class.php');
include_once('classes/pessoa.class.php');
include_once('classes/obs.class.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['cod_pessoa'])) {
    header('Location: index.php');
    exit();
}

$cod_pessoa = $_SESSION['cod_pessoa'];

function buscarDocumento($cod_pessoa, $cod_tipo_documento) {
    $documento = new Documentos();
    $resultado = $documento->buscarDocumentoPessoa($cod_pessoa, $cod_tipo_documento);

    if ($resultado && $resultado->rowCount() > 0) {
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    return null;
}

function buscarObservacao($cod_pessoa, $cod_tipo_documento) {
    $obs = new Obs();
    $documento = new Documentos();
    $documentoResultado = $documento->buscarDocumentoPessoa($cod_pessoa, $cod_tipo_documento);
    
    if ($documentoResultado && $documentoResultado->rowCount() > 0) {
        $documentoData = $documentoResultado->fetch(PDO::FETCH_ASSOC);
        if ($documentoData['status'] == 2) { // Se o documento estiver recusado
            $resultado = $obs->exibirobsPorDocumento($cod_pessoa, $cod_tipo_documento);
            if ($resultado && $resultado->rowCount() > 0) {
                return $resultado->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
    return null;
}


$result_d1 = buscarDocumento($cod_pessoa, 1); // Foto 3x4
$result_d2 = buscarDocumento($cod_pessoa, 2); // Laudo Médico
$result_d3 = buscarDocumento($cod_pessoa, 3); // Comprovante de Residência
$result_d4 = buscarDocumento($cod_pessoa, 4); // Documento de Identidade
$result_d5 = buscarDocumento($cod_pessoa, 5); // Requerimento

function getStatusIcon($status) {
    if ($status === null) {
        return 'locked';
    } elseif ($status == 0) {
        return 'pending';
    } elseif ($status == 1) {
        return 'completed';
    } elseif ($status == 2) {
        return 'error';
    }
    return 'locked';
}

// Verifica se todos os documentos estão completos
$allDocumentsCompleted = isset($result_d1['status']) && $result_d1['status'] == 1 &&
                         isset($result_d2['status']) && $result_d2['status'] == 1 &&
                         isset($result_d3['status']) && $result_d3['status'] == 1 &&
                         isset($result_d4['status']) && $result_d4['status'] == 1 &&
                         isset($result_d5['status']) && $result_d5['status'] == 1;

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - CIPTEA</title>
    <link rel="icon" href="images/imagemtopo.png" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('images/background_login2.webp') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            margin-top: 30px;
            max-width: 800px;
            width: 90%;
            overflow: hidden;
        }

        .step {
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .step-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2rem;
            color: #ffffff;
            flex-shrink: 0;
        }

        .step-icon.locked {
            background-color: #b0b0b0;
        }

        .step-icon.pending {
            background-color: #ffc107;
        }

        .step-icon.completed {
            background-color: #28a745;
        }

        .step-icon.error {
            background-color: #dc3545;
        }

        .upload-section {
            border: 2px dashed #007bff;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
            position: relative;
            width: 100%;
            box-sizing: border-box;
        }

        .upload-section.dragover {
            background-color: #e0f7ff;
        }

        .upload-section input[type="file"] {
            display: none;
        }

        .upload-section img {
            max-width: 200px;
            display: block;
            margin: 10px auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .header img {
            width: 250px;
            max-width: 100%;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 2rem;
            margin: 0;
            color: #007bff;
        }

        .logout-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        .uploaded-file {
            text-align: left;
            margin-top: 10px;
        }

        .uploaded-file a {
            color: #007bff;
            text-decoration: none;
        }

        .download-button,
        .view-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }

        .download-button:hover,
        .view-button:hover {
            background-color: #0056b3;
        }

        .view-button.disabled {
            background-color: #b0b0b0;
            cursor: not-allowed;
        }

        .edit-link {
            color: #007bff;
            font-weight: bold;
            text-decoration: underline;
        }

        .message {
            color: #28a745;
            font-size: 14px;
            margin-top: 10px;
        }

        .message.error {
            color: #dc3545;
            font-size: 24px;
            font-weight: bold;
        }
        .observation-message {
            font-size: 24px;
            font-weight: bold;
            color: #dc3545;
        }
        .observation-message::before {
            content: "Documento Recusado: ";
        }

        @media (max-width: 767px) {
            .step {
                flex-direction: column;
                align-items: flex-start;
            }

            .step-icon {
                margin-bottom: 10px;
                margin-right: 0;
            }

            .container {
                margin-top: 20px;
                padding: 20px;
            }

            .header img {
                width: 100%;
                max-width: 200px;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .upload-section img {
                max-width: 100%;
            }

            .logout-button {
                font-size: 14px;
                padding: 8px 16px;
            }

            .download-button,
            .view-button {
                font-size: 14px;
                padding: 8px 16px;
            }
        }

        @media (max-width: 575px) {
            .container {
                padding: 15px;
            }

            .header h1 {
                font-size: 1.2rem;
            }

            .step-icon {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .download-button,
            .view-button {
                font-size: 12px;
                padding: 6px 12px;
            }

            .logout-button {
                font-size: 12px;
                padding: 6px 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <a href="index.php">
                <img src="images/ciptea.png" alt="ciptea_logo">
            </a>
            <h1>Cadastro CIPTEA</h1>
            <button class="logout-button" onclick="window.location.href='processamento/logout.php'">Sair</button>
        </div>

        <h2>Passos para Cadastro</h2>
        <div class="step completed">
            <div class="step-icon completed"><i class="fas fa-user"></i></div>
            <div>
                <h4>1. Dados Pessoais</h4>
                <p>Caso queira alterar seus dados pessoais, clique <a href="reenviar_cadastro.php" class="edit-link">aqui</a>.</p>
            </div>
        </div>

        <form name="requerimento">
            <div class="step" id="step-2">
                <div class="step-icon <?php echo getStatusIcon($result_d5['status'] ?? null); ?>" id="requerimento-icon"><i class="fas fa-id-card"></i></div>
                <div>
                    <h4>2. Requerimento</h4>
                    <p>Para obter a carteira faça download do requerimento, imprima, assine e envie.</p>
                    <a href="formulario_requerimento.php?cod_pessoa=<?php echo $cod_pessoa; ?>" target="_blank" class="download-button">Baixar Requerimento</a>
                    <button type="button" class="view-button <?php echo $result_d5 ? '' : 'disabled'; ?>" <?php echo $result_d5 ? 'onclick="window.open(\'uploads/' . $result_d5['vch_documento'] . '\', \'_blank\');"' : ''; ?>>Ver Requerimento Enviado</button>
                    <div class="upload-section" onclick="document.getElementById('requerimento_upload').click()">
                        <input type="file" id="requerimento_upload" name="requerimento_upload" data-cod_tipo_documento="5" style="display:none;">
                        <p>Clique ou arraste o requerimento assinado aqui para enviar.</p>
                        <div class="uploaded-file" id="requerimento-uploaded"><?php if ($result_d5) { echo '<p>Arquivo enviado: ' . $result_d5['vch_documento'] . '</p>'; } ?></div>
                    </div>
                    <button type="button" id="uploadButtonRequerimento" class="btn btn-primary">Enviar Requerimento</button>
                    <div class="message" id="requerimento-message"></div>
                    <?php if ($observacoes = buscarObservacao($cod_pessoa, 5)) { foreach ($observacoes as $obs) { echo '<p class="observation-message">'.$obs['obs'].'</p>'; } } ?>
                </div>
            </div>
        </form>

        <form id="uploadFormFoto">
            <div class="step" id="step-3">
                <div class="step-icon <?php echo getStatusIcon($result_d1['status'] ?? null); ?>" id="foto-icon"><i class="fas fa-camera"></i></div>
                <div>
                    <h4>3. Foto 3x4</h4>
                    <p>Envie uma foto 3x4 para o seu documento.</p>
                    <div class="upload-section" onclick="document.getElementById('foto-34').click()">
                        <input type="file" id="foto-34" name="foto-34" data-cod_tipo_documento="1" style="display:none;">
                        <p>Clique ou arraste a foto 3x4 aqui.</p>
                        <?php if ($result_d1): ?>
                            <img src="uploads/<?php echo $result_d1['vch_documento']; ?>" alt="Foto 3x4">
                        <?php else: ?>
                            <img src="images/exemplo3.4.png" alt="Exemplo de Foto 3/4">
                        <?php endif; ?>
                        <div class="uploaded-file" id="foto-34-uploaded"><?php if ($result_d1) { echo '<p>Arquivo enviado: ' . $result_d1['vch_documento'] . '</p>'; } ?></div>
                    </div>
                    <button type="button" id="uploadButtonFoto" class="btn btn-primary">Enviar Foto 3x4</button>
                    <button type="button" class="view-button <?php echo $result_d1 ? '' : 'disabled'; ?>" <?php echo $result_d1 ? 'onclick="window.open(\'uploads/' . $result_d1['vch_documento'] . '\', \'_blank\');"' : ''; ?>>Ver Foto Enviada</button>
                    <div class="message" id="foto-message"></div>
                    <?php if ($observacoes = buscarObservacao($cod_pessoa, 1)) { foreach ($observacoes as $obs) { echo '<p class="observation-message">'.$obs['obs'].'</p>'; } } ?>
                </div>
            </div>
        </form>

        <form id="uploadFormIdentidade">
            <div class="step" id="step-4">
                <div class="step-icon <?php echo getStatusIcon($result_d4['status'] ?? null); ?>" id="identidade-icon"><i class="fas fa-id-card-alt"></i></div>
                <div>
                    <h4>4. Documento de Identidade</h4>
                    <p>Envie a imagem de um documento de identificação com foto (RG, CNH, etc).</p>
                    <div class="upload-section" onclick="document.getElementById('documento-identidade').click()">
                        <input type="file" id="documento-identidade" name="documento-identidade" data-cod_tipo_documento="4" style="display:none;">
                        <p>Clique ou arraste o documento de identidade aqui.</p>
                        <?php if ($result_d4): ?>
                            <img src="uploads/<?php echo $result_d4['vch_documento']; ?>" alt="Documento de Identidade">
                        <?php else: ?>
                            <img src="images/novacarteira.jpeg" alt="Exemplo de Documento de Identidade">
                        <?php endif; ?>
                        <div class="uploaded-file" id="documento-identidade-uploaded"><?php if ($result_d4) { echo '<p>Arquivo enviado: ' . $result_d4['vch_documento'] . '</p>'; } ?></div>
                    </div>
                    <button type="button" id="uploadButtonIdentidade" class="btn btn-primary">Enviar Documento de Identidade</button>
                    <button type="button" class="view-button <?php echo $result_d4 ? '' : 'disabled'; ?>" <?php echo $result_d4 ? 'onclick="window.open(\'uploads/' . $result_d4['vch_documento'] . '\', \'_blank\');"' : ''; ?>>Ver Documento de Identidade Enviado</button>
                    <div class="message" id="identidade-message"></div>
                    <?php if ($observacoes = buscarObservacao($cod_pessoa, 4)) { foreach ($observacoes as $obs) { echo '<p class="observation-message">'.$obs['obs'].'</p>'; } } ?>
                </div>
            </div>
        </form>

        <form id="uploadFormResidencia">
            <div class="step" id="step-5">
                <div class="step-icon <?php echo getStatusIcon($result_d3['status'] ?? null); ?>" id="residencia-icon"><i class="fas fa-home"></i></div>
                <div>
                    <h4>5. Comprovante de Residência</h4>
                    <p>Envie uma foto visível de um comprovante de residência.</p>
                    <div class="upload-section" onclick="document.getElementById('comprovante-residencia').click()">
                        <input type="file" id="comprovante-residencia" name="comprovante-residencia" data-cod_tipo_documento="3" style="display:none;">
                        <p>Clique ou arraste o comprovante aqui.</p>
                        <?php if ($result_d3): ?>
                            <img src="uploads/<?php echo $result_d3['vch_documento']; ?>" alt="Comprovante de Residência">
                        <?php else: ?>
                            <img src="images/comprovante-residencia.webp" alt="Exemplo de Comprovante de Residência">
                        <?php endif; ?>
                        <div class="uploaded-file" id="comprovante-residencia-uploaded"><?php if ($result_d3) { echo '<p>Arquivo enviado: ' . $result_d3['vch_documento'] . '</p>'; } ?></div>
                    </div>
                    <button type="button" id="uploadButtonResidencia" class="btn btn-primary">Enviar Comprovante de Residência</button>
                    <button type="button" class="view-button <?php echo $result_d3 ? '' : 'disabled'; ?>" <?php echo $result_d3 ? 'onclick="window.open(\'uploads/' . $result_d3['vch_documento'] . '\', \'_blank\');"' : ''; ?>>Ver Comprovante de Residência Enviado</button>
                    <div class="message" id="residencia-message"></div>
                    <?php if ($observacoes = buscarObservacao($cod_pessoa, 3)) { foreach ($observacoes as $obs) { echo '<p class="observation-message">'.$obs['obs'].'</p>'; } } ?>
                </div>
            </div>
        </form>

        <form id="uploadFormLaudo">
            <div class="step" id="step-6">
                <div class="step-icon <?php echo getStatusIcon($result_d2['status'] ?? null); ?>" id="laudo-icon"><i class="fas fa-file-medical"></i></div>
                <div>
                    <h4>6. Laudo Médico</h4>
                    <p>Envie o laudo médico da pessoa que vai usar a carteira.</p>
                    <div class="upload-section" onclick="document.getElementById('laudo-medico').click()">
                        <input type="file" id="laudo-medico" name="laudo-medico" data-cod_tipo_documento="2" style="display:none;">
                        <p>Clique ou arraste o laudo médico aqui.</p>
                        <?php if ($result_d2): ?>
                            <img src="uploads/<?php echo $result_d2['vch_documento']; ?>" alt="Laudo Médico">
                        <?php endif; ?>
                        <div class="uploaded-file" id="laudo-medico-uploaded"><?php if ($result_d2) { echo '<p>Arquivo enviado: ' . $result_d2['vch_documento'] . '</p>'; } ?></div>
                    </div>
                    <button type="button" id="uploadButtonLaudo" class="btn btn-primary">Enviar Laudo Médico</button>
                    <button type="button" class="view-button <?php echo $result_d2 ? '' : 'disabled'; ?>" <?php echo $result_d2 ? 'onclick="window.open(\'uploads/' . $result_d2['vch_documento'] . '\', \'_blank\');"' : ''; ?>>Ver Laudo Médico Enviado</button>
                    <div class="message" id="laudo-message"></div>
                    <?php if ($observacoes = buscarObservacao($cod_pessoa, 2)) { foreach ($observacoes as $obs) { echo '<p class="observation-message">'.$obs['obs'].'</p>'; } } ?>
                </div>
            </div>
        </form>

        <h2>Validação da Carteira</h2>
        <form id="generateCardForm">
            <div class="step">
                <div class="step-icon <?php echo $allDocumentsCompleted ? 'completed' : 'pending'; ?>" id="generate-card-icon"><i class="fas fa-id-badge"></i></div>
                <div>
                    <h4>Gerar Carteira</h4>
                    <button type="button" id="generateCardButton" class="btn btn-success" <?php echo $allDocumentsCompleted ? '' : 'disabled'; ?>>Gerar Carteira</button>
                    <div class="message" id="generate-card-message"></div>
                </div>
            </div>
        </form>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function () {
                function updateViewButton(stepId, fileName) {
                    var step = document.getElementById(stepId);
                    var viewButton = step.querySelector('.view-button');
                    viewButton.classList.remove('disabled');
                    viewButton.setAttribute('onclick', 'window.open("uploads/' + fileName + '", "_blank")');
                }

                function updateIcon(iconId, status) {
                    var icon = document.getElementById(iconId);
                    icon.className = 'step-icon ' + getStatusIcon(status);
                }

                function getStatusIcon(status) {
                    if (status === null) {
                        return 'locked';
                    } else if (status == 0) {
                        return 'pending';
                    } else if (status == 1) {
                        return 'completed';
                    } else if (status == 2) {
                        return 'error';
                    }
                    return 'locked';
                }

                function showMessage(elementId, message, isError = false) {
                    var element = document.getElementById(elementId);
                    element.textContent = message;
                    element.classList.toggle('error', isError);
                }

                $('#uploadButtonRequerimento').click(function () {
                    var fileInput = $('#requerimento_upload')[0];
                    if (fileInput.files.length === 0) {
                        showMessage('requerimento-message', 'Por favor, selecione um arquivo para enviar.', true);
                        return;
                    }
                    var file = fileInput.files[0];
                    var validFileTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                    if (!validFileTypes.includes(file.type)) {
                        showMessage('requerimento-message', 'Por favor, selecione um arquivo JPG, PNG ou PDF.', true);
                        return;
                    }
                    var formData = new FormData();
                    formData.append('file', file);
                    formData.append('cod_tipo_documento', fileInput.getAttribute('data-cod_tipo_documento'));
                    formData.append('cod_pessoa', '<?php echo $cod_pessoa; ?>');
                    $.ajax({
                        url: 'processamento/processar_upload.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            var res = JSON.parse(response);
                            $('#requerimento-uploaded').html('<p>Arquivo enviado: ' + res.fileName + '</p>');
                            updateIcon('requerimento-icon', 0); // Amarelo após o envio
                            updateViewButton('step-2', res.fileName);
                            showMessage('requerimento-message', res.message);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            showMessage('requerimento-message', 'Erro ao enviar o arquivo: ' + textStatus, true);
                        }
                    });
                });

                $('#uploadButtonFoto').click(function () {
                    var fileInput = $('#foto-34')[0];
                    if (fileInput.files.length === 0) {
                        showMessage('foto-message', 'Por favor, selecione um arquivo para enviar.', true);
                        return;
                    }
                    var file = fileInput.files[0];
                    var validFileTypes = ['image/jpeg', 'image/png'];
                    if (!validFileTypes.includes(file.type)) {
                        showMessage('foto-message', 'Por favor, selecione um arquivo JPG ou PNG.', true);
                        return;
                    }
                    var formData = new FormData();
                    formData.append('file', file);
                    formData.append('cod_tipo_documento', fileInput.getAttribute('data-cod_tipo_documento'));
                    formData.append('cod_pessoa', '<?php echo $cod_pessoa; ?>');
                    $.ajax({
                        url: 'processamento/processar_upload.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            var res = JSON.parse(response);
                            $('#foto-34-uploaded').html('<p>Arquivo enviado: ' + res.fileName + '</p>');
                            $('#foto-34').siblings('img').attr('src', 'uploads/' + res.fileName); // Atualiza a imagem exibida
                            updateIcon('foto-icon', 0); // Amarelo após o envio
                            updateViewButton('step-3', res.fileName);
                            showMessage('foto-message', res.message);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            showMessage('foto-message', 'Erro ao enviar o arquivo: ' + textStatus, true);
                        }
                    });
                });

                $('#uploadButtonIdentidade').click(function () {
                    var fileInput = $('#documento-identidade')[0];
                    if (fileInput.files.length === 0) {
                        showMessage('identidade-message', 'Por favor, selecione um arquivo para enviar.', true);
                        return;
                    }
                    var file = fileInput.files[0];
                    var validFileTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                    if (!validFileTypes.includes(file.type)) {
                        showMessage('identidade-message', 'Por favor, selecione um arquivo JPG, PNG ou PDF.', true);
                        return;
                    }
                    var formData = new FormData();
                    formData.append('file', file);
                    formData.append('cod_tipo_documento', fileInput.getAttribute('data-cod_tipo_documento'));
                    formData.append('cod_pessoa', '<?php echo $cod_pessoa; ?>');
                    $.ajax({
                        url: 'processamento/processar_upload.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            var res = JSON.parse(response);
                            $('#documento-identidade-uploaded').html('<p>Arquivo enviado: ' + res.fileName + '</p>');
                            $('#documento-identidade').siblings('img').attr('src', 'uploads/' + res.fileName); // Atualiza a imagem exibida
                            updateIcon('identidade-icon', 0); // Amarelo após o envio
                            updateViewButton('step-4', res.fileName);
                            showMessage('identidade-message', res.message);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            showMessage('identidade-message', 'Erro ao enviar o arquivo: ' + textStatus, true);
                        }
                    });
                });

                $('#uploadButtonResidencia').click(function () {
                    var fileInput = $('#comprovante-residencia')[0];
                    if (fileInput.files.length === 0) {
                        showMessage('residencia-message', 'Por favor, selecione um arquivo para enviar.', true);
                        return;
                    }
                    var file = fileInput.files[0];
                    var validFileTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                    if (!validFileTypes.includes(file.type)) {
                        showMessage('residencia-message', 'Por favor, selecione um arquivo JPG, PNG ou PDF.', true);
                        return;
                    }
                    var formData = new FormData();
                    formData.append('file', file);
                    formData.append('cod_tipo_documento', fileInput.getAttribute('data-cod_tipo_documento'));
                    formData.append('cod_pessoa', '<?php echo $cod_pessoa; ?>');
                    $.ajax({
                        url: 'processamento/processar_upload.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            var res = JSON.parse(response);
                            $('#comprovante-residencia-uploaded').html('<p>Arquivo enviado: ' + res.fileName + '</p>');
                            $('#comprovante-residencia').siblings('img').attr('src', 'uploads/' + res.fileName); // Atualiza a imagem exibida
                            updateIcon('residencia-icon', 0); // Amarelo após o envio
                            updateViewButton('step-5', res.fileName);
                            showMessage('residencia-message', res.message);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            showMessage('residencia-message', 'Erro ao enviar o arquivo: ' + textStatus, true);
                        }
                    });
                });

                $('#uploadButtonLaudo').click(function () {
                    var fileInput = $('#laudo-medico')[0];
                    if (fileInput.files.length === 0) {
                        showMessage('laudo-message', 'Por favor, selecione um arquivo para enviar.', true);
                        return;
                    }
                    var file = fileInput.files[0];
                    var validFileTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                    if (!validFileTypes.includes(file.type)) {
                        showMessage('laudo-message', 'Por favor, selecione um arquivo JPG, PNG ou PDF.', true);
                        return;
                    }
                    var formData = new FormData();
                    formData.append('file', file);
                    formData.append('cod_tipo_documento', fileInput.getAttribute('data-cod_tipo_documento'));
                    formData.append('cod_pessoa', '<?php echo $cod_pessoa; ?>');
                    $.ajax({
                        url: 'processamento/processar_upload.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            var res = JSON.parse(response);
                            $('#laudo-medico-uploaded').html('<p>Arquivo enviado: ' + res.fileName + '</p>');
                            $('#laudo-medico').siblings('img').attr('src', 'uploads/' + res.fileName); // Atualiza a imagem exibida
                            updateIcon('laudo-icon', 0); // Amarelo após o envio
                            updateViewButton('step-6', res.fileName);
                            showMessage('laudo-message', res.message);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            showMessage('laudo-message', 'Erro ao enviar o arquivo: ' + textStatus, true);
                        }
                    });
                });

                $('#requerimento_upload').on('change', function () {
                    var fileName = $(this).val().split('\\').pop();
                    $('#requerimento-uploaded').html('<p>Arquivo selecionado: ' + fileName + '</p>');
                });
                $('#foto-34').on('change', function () {
                    var fileName = $(this).val().split('\\').pop();
                    $('#foto-34-uploaded').html('<p>Arquivo selecionado: ' + fileName + '</p>');
                });
                $('#documento-identidade').on('change', function () {
                    var fileName = $(this).val().split('\\').pop();
                    $('#documento-identidade-uploaded').html('<p>Arquivo selecionado: ' + fileName + '</p>');
                });
                $('#comprovante-residencia').on('change', function () {
                    var fileName = $(this).val().split('\\').pop();
                    $('#comprovante-residencia-uploaded').html('<p>Arquivo selecionado: ' + fileName + '</p>');
                });
                $('#laudo-medico').on('change', function () {
                    var fileName = $(this).val().split('\\').pop();
                    $('#laudo-medico-uploaded').html('<p>Arquivo selecionado: ' + fileName + '</p>');
                });

                $('#generateCardButton').click(function () {
                    $.ajax({
                        url: 'processamento/verificar_documentos.php',
                        type: 'POST',
                        data: { action: 'verify_documents', cod_pessoa: '<?php echo $cod_pessoa; ?>' },
                        success: function (response) {
                            var res = JSON.parse(response);
                            if (res.allDocuments) {
                                $.ajax({
                                    url: 'processamento/gerar_carteira.php',
                                    type: 'POST',
                                    data: { cod_pessoa: '<?php echo $cod_pessoa; ?>' },
                                    success: function (response) {
                                        var res = JSON.parse(response);
                                        if (res.success) {
                                            showMessage('generate-card-message', "Carteira gerada com sucesso!");
                                            window.open('carteirinha.php?cod_pessoa=<?php echo $cod_pessoa; ?>', '_blank');
                                        } else {
                                            showMessage('generate-card-message', "Erro ao gerar a carteira: " + res.message, true);
                                        }
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        showMessage('generate-card-message', "Erro ao gerar a carteira: " + textStatus, true);
                                    }
                                });
                            } else {
                                showMessage('generate-card-message', "Por favor, envie todos os documentos obrigatórios antes de gerar a carteira.", true);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            showMessage('generate-card-message', "Erro ao verificar documentos: " + textStatus, true);
                        }
                    });
                });

                <?php if ($result_d5): ?>
                    updateIcon('requerimento-icon', <?php echo $result_d5['status']; ?>);
                <?php endif; ?>
                <?php if ($result_d1): ?>
                    updateIcon('foto-icon', <?php echo $result_d1['status']; ?>);
                <?php endif; ?>
                <?php if ($result_d4): ?>
                    updateIcon('identidade-icon', <?php echo $result_d4['status']; ?>);
                <?php endif; ?>
                <?php if ($result_d3): ?>
                    updateIcon('residencia-icon', <?php echo $result_d3['status']; ?>);
                <?php endif; ?>
                <?php if ($result_d2): ?>
                    updateIcon('laudo-icon', <?php echo $result_d2['status']; ?>);
                <?php endif; ?>
            });
        </script>
</body>

</html>
