<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Configurações básicas da página -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - CIPTEA</title>
    <!-- Favicon da página -->
    <link rel="icon" href="images/imagemtopo.png" type="image/png">
    <!-- Bootstrap CSS para estilos prontos -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Fonte personalizada do Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Estilo do corpo da página */
        body {
            background: url('images/background_login2.webp') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Estilo do contêiner principal */
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

        /* Estilo de cada passo do cadastro */
        .step {
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
        }

        /* Estilo dos ícones de cada passo */
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

        /* Ícones bloqueados */
        .step-icon.locked {
            background-color: #b0b0b0;
        }

        /* Ícones desbloqueados */
        .step-icon.unlocked {
            background-color: #808080;
        }

        /* Ícones completados */
        .step-icon.completed {
            background-color: #28a745;
        }

        /* Ícones pendentes */
        .step-icon.pending {
            background-color: #ffc107;
        }

        /* Estilo da seção de upload */
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

        /* Estilo ao arrastar arquivo sobre a seção de upload */
        .upload-section.dragover {
            background-color: #e0f7ff;
        }

        /* Ocultar o input de arquivo */
        .upload-section input[type="file"] {
            display: none;
        }

        /* Estilo da imagem na seção de upload */
        .upload-section img {
            max-width: 200px;
            display: block;
            margin: 10px auto;
        }

        /* Estilo do cabeçalho */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        /* Estilo da imagem no cabeçalho */
        .header img {
            width: 300px;
            margin-bottom: 10px;
        }

        /* Estilo do título no cabeçalho */
        .header h1 {
            font-size: 2rem;
            margin: 0;
            color: #007bff;
        }

        /* Estilo do passo completado */
        .step.completed {
            background-color: #e6ffe6;
            border: 1px solid #28a745;
        }

        /* Estilo da seção de verificação */
        .verification-section {
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
        }

        /* Estilo do arquivo enviado */
        .uploaded-file {
            text-align: left;
            margin-top: 10px;
        }

        /* Estilo do link do arquivo enviado */
        .uploaded-file a {
            color: #007bff;
            text-decoration: none;
        }

        /* Estilo do botão de download */
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

        /* Estilo do botão de download ao passar o mouse */
        .download-button:hover {
            background-color: #0056b3;
        }

        /* Estilo responsivo para telas menores */
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
            <!-- Logo do site -->
            <img src="images/ciptea.png" alt="ciptea_logo">
        </a>
        <h1>Cadastro CIPTEA</h1>
    </div>

    <h2>Passos para Cadastro</h2>
    <div class="step">
        <div class="step-icon unlocked"><i class="fas fa-user"></i></div>
        <div>
            <h4>1. Dados Pessoais</h4>
            <p>Preencheu seus dados pessoais, caso queira editar clique <a href="">aqui</a>.</p>
        </div>
    </div>
    <div class="step">
        <div class="step-icon unlocked"><i class="fas fa-id-card"></i></div>
        <div>
            <h4>2. Requerimento</h4>
            <p>Para obter a carteira, primeiro faça o download do requerimento, imprima, assine. Em seguida tire uma foto e envie assinado.</p>
            <!-- Botão para baixar o requerimento -->
            <a href="requerimento.pdf" class="download-button">Baixar Requerimento</a>
            <div class="upload-section" onclick="document.getElementById('requerimento-upload').click()">
                <input type="file" id="requerimento-upload" onchange="handleFileUpload(this)">
                <p>Clique ou arraste o requerimento assinado aqui para enviar.</p>
                <div class="uploaded-file" id="requerimento-uploaded"></div>
            </div>
        </div>
    </div>
    <div class="step">
        <div class="step-icon unlocked"><i class="fas fa-camera"></i></div>
        <div>
            <h4>3. Foto 3x4</h4>
            <p>Agora você vai enviar a foto que vai aparecer na carteira, como o exemplo abaixo</p>
            <div class="upload-section" onclick="document.getElementById('foto-34').click()">
                <input type="file" id="foto-34" onchange="handleFileUpload(this)">
                <p>Clique ou arraste a foto 3x4 aqui.</p>
                <img src="images/exemplo3.4.png" alt="Exemplo de Foto 3/4">
                <div class="uploaded-file" id="foto-34-uploaded"></div>
            </div>
        </div>
    </div>
    <div class="step">
        <div class="step-icon unlocked"><i class="fas fa-id-card-alt"></i></div>
        <div>
            <h4>4. Documento de Identidade</h4>
            <p>Envie a imagem de um documento de identificação com foto (RG, CNH e etc) conforme o exemplo abaixo</p>
            <div class="upload-section" onclick="document.getElementById('documento-identidade').click()">
                <input type="file" id="documento-identidade" onchange="handleFileUpload(this)">
                <p>Clique ou arraste o documento de identidade aqui.</p>
                <img src="images/novacarteira.jpeg" alt="Exemplo de Documento de Identidade">
                <div class="uploaded-file" id="documento-identidade-uploaded"></div>
            </div>
        </div>
    </div>
    <div class="step">
        <div class="step-icon unlocked"><i class="fas fa-home"></i></div>
        <div>
            <h4>5. Comprovante de Residência</h4>
            <p>Envie uma foto visível de um comprovante de residência, como exemplo abaixo</p>
            <div class="upload-section" onclick="document.getElementById('comprovante-residencia').click()">
                <input type="file" id="comprovante-residencia" onchange="handleFileUpload(this)">
                <p>Clique ou arraste o comprovante aqui.</p>
                <img src="images/comprovante-residencia.webp" alt="Exemplo de Comprovante de Residência">
                <div class="uploaded-file" id="comprovante-residencia-uploaded"></div>
            </div>
        </div>
    </div>
    <div class="step">
        <div class="step-icon unlocked"><i class="fas fa-file-medical"></i></div>
        <div>
            <h4>6. Laudo Médico</h4>
            <p>Envie o laudo médico da pessoa que vai usar a carteira.</p>
            <div class="upload-section" onclick="document.getElementById('laudo-medico').click()">
                <input type="file" id="laudo-medico" onchange="handleFileUpload(this)">
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
    // Adiciona evento para os elementos de upload quando a página é carregada
    document.addEventListener('DOMContentLoaded', function() {
        var uploadSections = document.querySelectorAll('.upload-section');
        uploadSections.forEach(function(section) {
            // Adiciona classe dragover quando um arquivo é arrastado sobre a seção
            section.addEventListener('dragover', function(event) {
                event.preventDefault();
                section.classList.add('dragover');
            });

            // Remove classe dragover quando um arquivo é arrastado para fora da seção
            section.addEventListener('dragleave', function(event) {
                section.classList.remove('dragover');
            });

            // Lida com o evento de soltar arquivo na seção
            section.addEventListener('drop', function(event) {
                event.preventDefault();
                section.classList.remove('dragover');
                var input = section.querySelector('input[type="file"]');
                input.files = event.dataTransfer.files;
                handleFileUpload(input);
            });
        });
    });

    // Função para lidar com o upload de arquivos
    function handleFileUpload(input) {
        var formData = new FormData();
        formData.append('file', input.files[0]);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'upload_endpoint.php', true); // Altere 'upload_endpoint.php' para a URL real de upload
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    var section = input.closest('.step');
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
                        var confirmButton = document.querySelector('.upload-button');
                        confirmButton.classList.add('active');
                        confirmButton.disabled = false;

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