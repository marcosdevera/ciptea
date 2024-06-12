<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - CIPTEA</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('images/background_login2.webp') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
            max-width: 800px;
        }

        .step {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .step-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.5rem;
            color: #ffffff;
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

        .upload-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        .upload-button:hover {
            background-color: #45a049;
        }

        .download-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .download-button:hover {
            background-color: #0056b3;
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

        .step.completed {
            background-color: #e6ffe6;
            border: 1px solid #28a745;
        }

        .verification-section {
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
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
    <div class="step">
        <div class="step-icon unlocked"><i class="fas fa-user"></i></div>
        <div>
            <h4>1. Dados Pessoais</h4>
            <p>Preencha seus dados pessoais.</p>
        </div>
    </div>
    <div class="step">
        <div class="step-icon unlocked"><i class="fas fa-id-card"></i></div>
        <div>
            <h4>2. Requerimento</h4>
            <p>Para obter a carteira, primeira faça o download do requerimento, imprima, assine. Em seguida tire uma foto e envie assinado.
            <button class="download-button">Baixar Requerimento</button>
            <div class="upload-section" onclick="document.getElementById('requerimento-upload').click()">
                <input type="file" id="requerimento-upload" onchange="markCompleted(this)">
                <p>Clique ou arraste o requerimento assinado aqui para enviar.</p>
             
            </div>
        </div>
    </div>
    <div class="step">
        <div class="step-icon unlocked"><i class="fas fa-camera"></i></div>
        <div>
            <h4>3. Foto 3x4</h4>
            <p>Agora você vai enviar a foto que vai aparecer na carteira, como o exemplo abaixo</p>
            <div class="upload-section" onclick="document.getElementById('foto-34').click()">
                <input type="file" id="foto-34" onchange="markCompleted(this)">
                <p>Clique ou arraste a foto 3x4 aqui.</p>
                <img src="images/exemplo3.4.png" alt="Exemplo de Foto 3/4">
            </div>
        </div>
    </div>
    <div class="step">
        <div class="step-icon unlocked"><i class="fas fa-id-card"></i></div>
        <div>
            <h4>4. Documento de Identidade</h4>
            <p>Envie a imagem de um documento de indentificação com foto (RG, CNH e etc) conforme o exemplo abaixo</p>
            <div class="upload-section" onclick="document.getElementById('documento-identidade').click()">
                <input type="file" id="documento-identidade" onchange="markCompleted(this)">
                <p>Clique ou arraste o documento de identidade aqui.</p>
                <img src="images/novacarteira.jpeg" alt="Exemplo de Documento de Identidade">
            </div>
        </div>
    </div>
    <div class="step">
        <div class="step-icon unlocked"><i class="fas fa-home"></i></div>
        <div>
            <h4>5. Comprovante de Residência</h4>
            <p>Envie uma foto visivel de um comprovante de residencia, como exemplo abaixo</p>
            <div class="upload-section" onclick="document.getElementById('comprovante-residencia').click()">
                <input type="file" id="comprovante-residencia" onchange="markCompleted(this)">
                <p>Clique ou arraste o comprovante aqui.</p>
                <img src="images/comprovante-residencia.webp" alt="Exemplo de Comprovante de Residência">
            </div>
        </div>
    </div>
    <div class="step">
        <div class="step-icon unlocked"><i class="fas fa-file-medical"></i></div>
        <div>
            <h4>6. Laudo Médico</h4>
            <p>Envie o laudo medico da pessoa que vai usar a carteira.</p>
            <div class="upload-section" onclick="document.getElementById('laudo-medico').click()">
                <input type="file" id="laudo-medico" onchange="markCompleted(this)">
                <p>Clique ou arraste o laudo médico aqui.</p>
                <img src="images/seu-modelo-de-laudo-medico.png" alt="Exemplo de Laudo Médico">
                <button class="upload-button">Enviar Documentos</button>
            </div>
        </div>
    </div>
    <div class="step">
        <div class="step-icon unlocked"><i class="fas fa-check-circle"></i></div>
        <div>
            <h4>7. Confirmação</h4>
            <p>Confirme e envie os documentos.</p>
            <button class="upload-button">Enviar Documentos</button>
        </div>
    </div>

    <h2>Validação da Carteira</h2>
    <div class="step">
        <div class="step-icon pending" id="validator-step"><i class="fas fa-id-badge"></i></div>
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
                markCompleted(input);
            });

            section.addEventListener('click', function() {
                var input = section.querySelector('input[type="file"]');
                input.click();
            });
        });
    });

    function markCompleted(input) {
        var section = input.closest('.step');
        var icon = section.querySelector('.step-icon');
        icon.classList.add('completed');
        icon.classList.remove('unlocked');

        // Atualiza o próximo passo
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

            // Habilita o passo de validação
            var validatorStep = document.getElementById('validator-step');
            if (validatorStep) {
                validatorStep.classList.add('pending');
                validatorStep.classList.remove('locked');
            }
        }
    }

    function approveWallet() {
        var walletStep = document.querySelector('.step-icon.pending');
        walletStep.classList.add('completed');
        walletStep.classList.remove('pending');
    }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
