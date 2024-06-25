<?php
include_once('sessao.php');
include_once('classes/documentos.class.php');
include_once('classes/pessoa.class.php');

$cod_pessoa = $_SESSION['cod_pessoa'];

//Objeto que busca o requerimen to do usuario
$d5 = new Documentos();
$result_d5 = $d5->buscarDocumentoPessoa($cod_pessoa, 5);


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
        }
        .container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            margin-top: 30px;
            max-width: 800px;
            width: 90%;
            margin: auto;
        }
        .step {
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
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
        .step-icon.unlocked {
            background-color: #808080;
        }
        .step-icon.completed {
            background-color: #28a745;
        }
        .step-icon.pending {
            background-color: #ffc107;
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
        }
        .header img {
            width: 300px;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 2rem;
            margin: 0;
            color: #007bff;
        }
        .verification-section {
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
        }
        .uploaded-file {
            text-align: left;
            margin-top: 10px;
        }
        .uploaded-file a {
            color: #007bff;
            text-decoration: none;
        }
        .download-button {
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
        .download-button:hover {
            background-color: #0056b3;
        }
        .edit-link {
            color: #007bff;
            font-weight: bold;
            text-decoration: underline;
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
    </div>

    <h2>Passos para Cadastro</h2>
    <div class="step completed">
        <div class="step-icon completed"><i class="fas fa-user"></i></div>
        <div>
            <h4>1. Dados Pessoais</h4>
            <p>Preencheu seus dados pessoais, caso queira editar clique <a href="reenviar_cadastro.php" class="edit-link">aqui</a>.</p>
        </div>
    </div>
    <div class="step" id="step-2">
        <div class="step-icon unlocked"><i class="fas fa-id-card"></i></div>
        <div>
            <h4>2. Requerimento</h4>
            <p>Para obter a carteira, primeiro faça o download do requerimento, imprima e assine. Em seguida tire uma foto e envie o documento que você assinou.</p>
            <a href="formulario_requerimento.php?cod_pessoa=<?php echo $cod_pessoa; ?>"  class="download-button">Baixar Requerimento</a>
            <?php if ($result_d5->rowCount() > 0) {
                    $row_requetimento = $result_d5->fetch(PDO::FETCH_ASSOC);
                    echo 'Documento: ' . $row_requetimento['vch_documento'];
                }else{
                    echo 'não existe requerimento ';    
                
                }

            ?>
            <div class="upload-section" onclick="document.getElementById('requerimento-upload').click()">
                <input type="file" id="requerimento-upload" data-cod_tipo_documento="5" onchange="handleFileUpload(this)">
                <p>Clique ou arraste o requerimento assinado aqui para enviar.</p>
                <div class="uploaded-file" id="requerimento-uploaded"></div>
            </div>
        </div>
    </div>
    <div class="step" id="step-3">
        <div class="step-icon unlocked"><i class="fas fa-camera"></i></div>
        <div>
            <h4>3. Foto 3x4</h4>
            <p>Agora você vai enviar a foto que vai aparecer na carteira, como o exemplo abaixo</p>
            <div class="upload-section" onclick="document.getElementById('foto-34').click()">
                <input type="file" id="foto-34" data-cod_tipo_documento="1" onchange="handleFileUpload(this)">
                <p>Clique ou arraste a foto 3x4 aqui.</p>
                <img src="images/exemplo3.4.png" alt="Exemplo de Foto 3/4">
                <div class="uploaded-file" id="foto-34-uploaded"></div>
            </div>
        </div>
    </div>
    <div class="step" id="step-4">
        <div class="step-icon unlocked"><i class="fas fa-id-card-alt"></i></div>
        <div>
            <h4>4. Documento de Identidade</h4>
            <p>Envie a imagem de um documento de identificação com foto (RG, CNH e etc) conforme o exemplo abaixo</p>
            <div class="upload-section" onclick="document.getElementById('documento-identidade').click()">
                <input type="file" id="documento-identidade" data-cod_tipo_documento="4" onchange="handleFileUpload(this)">
                <p>Clique ou arraste o documento de identidade aqui.</p>
                <img src="images/novacarteira.jpeg" alt="Exemplo de Documento de Identidade">
                <div class="uploaded-file" id="documento-identidade-uploaded"></div>
            </div>
        </div>
    </div>
    <div class="step" id="step-5">
        <div class="step-icon unlocked"><i class="fas fa-home"></i></div>
        <div>
            <h4>5. Comprovante de Residência</h4>
            <p>Envie uma foto visível de um comprovante de residência, como exemplo abaixo</p>
            <div class="upload-section" onclick="document.getElementById('comprovante-residencia').click()">
                <input type="file" id="comprovante-residencia" data-cod_tipo_documento="3" onchange="handleFileUpload(this)">
                <p>Clique ou arraste o comprovante aqui.</p>
                <img src="images/comprovante-residencia.webp" alt="Exemplo de Comprovante de Residência">
                <div class="uploaded-file" id="comprovante-residencia-uploaded"></div>
            </div>
        </div>
    </div>
    <div class="step" id="step-6">
        <div class="step-icon unlocked"><i class="fas fa-file-medical"></i></div>
        <div>
            <h4>6. Laudo Médico</h4>
            <p>Envie o laudo médico da pessoa que vai usar a carteira.</p>
            <div class="upload-section" onclick="document.getElementById('laudo-medico').click()">
                <input type="file" id="laudo-medico" data-cod_tipo_documento="2" onchange="handleFileUpload(this)">
                <p>Clique ou arraste o laudo médico aqui.</p>
                <div class="uploaded-file" id="laudo-medico-uploaded"></div>
            </div>
        </div>
    </div>

    <h2>Validação da Carteira</h2>
    <div class="step">
        <div class="step-icon pending" id="validator-step"><i class="fas fa-check-circle"></i></div>
        <div>
            <h4>Validação da Carteira</h4>
            <p>Aguarde a validação da sua carteira. Ela ficará amarela até ser aprovada.</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var uploadSections = document.querySelectorAll('.upload-section');
        uploadSections.forEach(function(section) {
            section.addEventListener('dragover', function(event) {
                event.preventDefault();
                section.classList.add('dragover');
            });

            section.addEventListener('dragleave', function(event) {
                section.classList.remove('dragover');
            });

            section.addEventListener('drop', function(event) {
                event.preventDefault();
                section.classList.remove('dragover');
                var input = section.querySelector('input[type="file"]');
                input.files = event.dataTransfer.files;
                handleFileUpload(input);
            });
        });
    });

    function handleFileUpload(input) {
        var formData = new FormData();
        var codTipoDocumento = input.getAttribute('data-cod_tipo_documento');
        formData.append(input.name, input.files[0]);
        formData.append('cod_tipo_documento', codTipoDocumento);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'processamento/processar_upload.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) { 
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    var section = document.getElementById('step-' + codTipoDocumento);
                    var icon = section.querySelector('.step-icon');
                    icon.classList.add('completed');
                    icon.classList.remove('unlocked');

                    var uploadedFileDiv = section.querySelector('.uploaded-file');
                    uploadedFileDiv.innerHTML = `<a href="${response.filepath}" target="_blank">Ver Arquivo</a>`;

                    var nextStep = section.nextElementSibling;
                    if (nextStep && nextStep.querySelector('.step-icon')) {
                        var nextIcon = nextStep.querySelector('.step-icon');
                        nextIcon.classList.remove('locked');
                        nextIcon.classList.add('unlocked');
                    }

                    var allCompleted = true;
                    document.querySelectorAll('.step-icon').forEach(function(icon) {
                        if (!icon.classList.contains('completed') && !icon.classList.contains('unlocked')) {
                            allCompleted = false;
                        }
                    });

                    if (allCompleted) {
                        var validatorStep = document.getElementById('validator-step');
                        if (validatorStep) {
                            validatorStep.classList.add('pending');
                            validatorStep.classList.remove('locked');
                        }
                    }
                } else {
                    alert('O upload falhou, tente novamente.');
                }
            }
        };
        xhr.send(formData);
    }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
