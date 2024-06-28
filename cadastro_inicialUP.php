<?php
include_once('sessao.php');
include_once('classes/documentos.class.php');
include_once('classes/pessoa.class.php');

if (!isset($_SESSION)) {
    session_start();
}

$cod_pessoa = $_SESSION['cod_pessoa'];

// Função para buscar documentos e verificar resultados
function buscarDocumento($cod_pessoa, $cod_tipo_documento) {
    $documento = new Documentos();
    $resultado = $documento->buscarDocumentoPessoa($cod_pessoa, $cod_tipo_documento);

    if ($resultado && $resultado->rowCount() > 0) {
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    return null;
}

$result_d1 = buscarDocumento($cod_pessoa, 1); // Foto 3x4
$result_d2 = buscarDocumento($cod_pessoa, 2); // Laudo Médico
$result_d3 = buscarDocumento($cod_pessoa, 3); // Comprovante de Residência
$result_d4 = buscarDocumento($cod_pessoa, 4); // Documento de Identidade
$result_d5 = buscarDocumento($cod_pessoa, 5); // Requerimento
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
      /* Aumentado para melhor visualização */
      display: block;
      margin: 10px auto;
    }

    .header {
      text-align: center;
      margin-bottom: 30px;
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
        <p>Preencheu seus dados pessoais, caso queira editar clique <a href="reenviar_cadastro.php"
            class="edit-link">aqui</a>.</p>
      </div>
    </div>

    <form name="requerimento">
      <div class="step" id="step-2">
        <div class="step-icon unlocked" id="requerimento-icon"><i class="fas fa-id-card"></i></div>
        <div>
          <h4>2. Requerimento</h4>
          <p>Para obter a carteira, primeiro faça o download do requerimento, imprima e assine. Em seguida tire uma foto
            e envie o documento que você assinou.</p>
          <a href="formulario_requerimento.php?cod_pessoa=<?php echo $cod_pessoa; ?>" target="_blank"
            class="download-button">Baixar Requerimento</a>
          <button type="button" class="view-button <?php echo $result_d5 ? '' : 'disabled'; ?>" <?php echo $result_d5
            ? 'onclick="window.open(\' uploads/' . $result_d5['vch_documento'] . '\' , \'_blank\');"' : '' ; ?>>
            Ver Requerimento Enviado
          </button>
          <div class="upload-section" onclick="document.getElementById('requerimento_upload').click()">
            <input type="file" id="requerimento_upload" name="requerimento_upload" data-cod_tipo_documento="5"
              style="display:none;">
            <p>Clique ou arraste o requerimento assinado aqui para enviar.</p>
            <div class="uploaded-file" id="requerimento-uploaded"></div>
          </div>
          <button type="button" id="uploadButtonRequerimento" class="btn btn-primary">Enviar Requerimento</button>
        </div>
      </div>
    </form>

    <form id="uploadFormFoto">
      <div class="step" id="step-3">
        <div class="step-icon unlocked" id="foto-icon"><i class="fas fa-camera"></i></div>
        <div>
          <h4>3. Foto 3x4</h4>
          <p>Envie uma foto 3x4 para o seu documento.</p>
          <div class="upload-section" onclick="document.getElementById('foto-34').click()">
            <input type="file" id="foto-34" name="foto-34" data-cod_tipo_documento="1" style="display:none;">
            <p>Clique ou arraste a foto 3x4 aqui.</p>
            <img src="images/exemplo3.4.png" alt="Exemplo de Foto 3/4">
            <div class="uploaded-file" id="foto-34-uploaded"></div>
          </div>
          <button type="button" id="uploadButtonFoto" class="btn btn-primary">Enviar Foto 3x4</button>
          <button type="button" class="view-button <?php echo $result_d1 ? '' : 'disabled'; ?>" <?php echo $result_d1
            ? 'onclick="window.open(\' uploads/' . $result_d1['vch_documento'] . '\' , \'_blank\');"' : '' ; ?>>
            Ver Foto Enviada
          </button>
        </div>
      </div>
    </form>

    <form id="uploadFormIdentidade">
      <div class="step" id="step-4">
        <div class="step-icon unlocked" id="identidade-icon"><i class="fas fa-id-card-alt"></i></div>
        <div>
          <h4>4. Documento de Identidade</h4>
          <p>Envie a imagem de um documento de identificação com foto (RG, CNH e etc).</p>
          <div class="upload-section" onclick="document.getElementById('documento-identidade').click()">
            <input type="file" id="documento-identidade" name="documento-identidade" data-cod_tipo_documento="4"
              style="display:none;">
            <p>Clique ou arraste o documento de identidade aqui.</p>
            <img src="images/novacarteira.jpeg" alt="Exemplo de Documento de Identidade">
            <div class="uploaded-file" id="documento-identidade-uploaded"></div>
          </div>
          <button type="button" id="uploadButtonIdentidade" class="btn btn-primary">Enviar Documento de
            Identidade</button>
          <button type="button" class="view-button <?php echo $result_d4 ? '' : 'disabled'; ?>" <?php echo $result_d4
            ? 'onclick="window.open(\' uploads/' . $result_d4['vch_documento'] . '\' , \'_blank\');"' : '' ; ?>>
            Ver Documento de Identidade Enviado
          </button>
        </div>
      </div>
    </form>

    <form id="uploadFormResidencia">
      <div class="step" id="step-5">
        <div class="step-icon unlocked" id="residencia-icon"><i class="fas fa-home"></i></div>
        <div>
          <h4>5. Comprovante de Residência</h4>
          <p>Envie uma foto visível de um comprovante de residência.</p>
          <div class="upload-section" onclick="document.getElementById('comprovante-residencia').click()">
            <input type="file" id="comprovante-residencia" name="comprovante-residencia" data-cod_tipo_documento="3"
              style="display:none;">
            <p>Clique ou arraste o comprovante aqui.</p>
            <img src="images/comprovante-residencia.webp" alt="Exemplo de Comprovante de Residência">
            <div class="uploaded-file" id="comprovante-residencia-uploaded"></div>
          </div>
          <button type="button" id="uploadButtonResidencia" class="btn btn-primary">Enviar Comprovante de
            Residência</button>
          <button type="button" class="view-button <?php echo $result_d3 ? '' : 'disabled'; ?>" <?php echo $result_d3
            ? 'onclick="window.open(\' uploads/' . $result_d3['vch_documento'] . '\' , \'_blank\');"' : '' ; ?>>
            Ver Comprovante de Residência Enviado
          </button>
        </div>
      </div>
    </form>

    <form id="uploadFormLaudo">
      <div class="step" id="step-6">
        <div class="step-icon unlocked" id="laudo-icon"><i class="fas fa-file-medical"></i></div>
        <div>
          <h4>6. Laudo Médico</h4>
          <p>Envie o laudo médico da pessoa que vai usar a carteira.</p>
          <div class="upload-section" onclick="document.getElementById('laudo-medico').click()">
            <input type="file" id="laudo-medico" name="laudo-medico" data-cod_tipo_documento="2" style="display:none;">
            <p>Clique ou arraste o laudo médico aqui.</p>
            <div class="uploaded-file" id="laudo-medico-uploaded"></div>
          </div>
          <button type="button" id="uploadButtonLaudo" class="btn btn-primary">Enviar Laudo Médico</button>
          <button type="button" class="view-button <?php echo $result_d2 ? '' : 'disabled'; ?>" <?php echo $result_d2
            ? 'onclick="window.open(\' uploads/' . $result_d2['vch_documento'] . '\' , \'_blank\');"' : '' ; ?>>
            Ver Laudo Médico Enviado
          </button>
        </div>
      </div>
    </form>

    <h2>Validação da Carteira</h2>
    <form id="generateCardForm">
    <div class="step">
        <div class="step-icon pending" id="generate-card-icon"><i class="fas fa-id-badge"></i></div>
        <div>
            <h4>Gerar Carteira</h4>
            <button type="button" id="generateCardButton" class="btn btn-success">Gerar Carteira</button>
        </div>
    </div>
</form>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var uploadSections = document.querySelectorAll('.upload-section');
      uploadSections.forEach(function (section) {
        section.addEventListener('dragover', function (event) {
          event.preventDefault();
          section.classList.add('dragover');
        });

        section.addEventListener('dragleave', function (event) {
          section.classList.remove('dragover');
        });

        section.addEventListener('drop', function (event) {
          event.preventDefault();
          section.classList.remove('dragover');
          var input = section.querySelector('input[type="file"]');
          input.files = event.dataTransfer.files;
          handleFileUpload(input);
        });
      });
    });

    $(document).ready(function () {
      function updateViewButton(stepId, fileName) {
        var step = document.getElementById(stepId);
        var viewButton = step.querySelector('.view-button');
        viewButton.classList.remove('disabled');
        viewButton.setAttribute('onclick', 'window.open("uploads/' + fileName + '", "_blank")');
      }

      // Função para atualizar o ícone
      function updateIcon(iconId) {
        var icon = document.getElementById(iconId);
        icon.classList.remove('unlocked');
        icon.classList.add('completed');
      }

      $('#uploadButtonRequerimento').click(function () {
        var fileInput = $('#requerimento_upload')[0];
        if (fileInput.files.length === 0) {
          alert("Por favor, selecione um arquivo para enviar.");
          return;
        }
        var file = fileInput.files[0];
        var validFileTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        if (!validFileTypes.includes(file.type)) {
          alert("Por favor, selecione um arquivo JPG, PNG ou PDF.");
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
            $('#requerimento-uploaded').html('<a href="../uploads/' + res.fileName + '" target="_blank">Ver Requerimento Enviado</a>');
            updateIcon('requerimento-icon');
            updateViewButton('step-2', res.fileName);
            alert(res.message);
          },
          error: function (jqXHR, textStatus, errorThrown) {
            alert("Erro ao enviar o arquivo: " + textStatus);
          }
        });
      });

      // Repetir a função para outros uploads (foto, identidade, etc)
      $('#uploadButtonFoto').click(function () {
        var fileInput = $('#foto-34')[0];
        if (fileInput.files.length === 0) {
          alert("Por favor, selecione um arquivo para enviar.");
          return;
        }
        var file = fileInput.files[0];
        var validFileTypes = ['image/jpeg', 'image/png'];
        if (!validFileTypes.includes(file.type)) {
          alert("Por favor, selecione um arquivo JPG ou PNG.");
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
            $('#foto-34-uploaded').html('<a href="../uploads/' + res.fileName + '" target="_blank">Ver Foto Enviada</a>');
            updateIcon('foto-icon');
            updateViewButton('step-3', res.fileName);
            alert(res.message);
          },
          error: function (jqXHR, textStatus, errorThrown) {
            alert("Erro ao enviar o arquivo: " + textStatus);
          }
        });
      });

      $('#uploadButtonIdentidade').click(function () {
        var fileInput = $('#documento-identidade')[0];
        if (fileInput.files.length === 0) {
          alert("Por favor, selecione um arquivo para enviar.");
          return;
        }
        var file = fileInput.files[0];
        var validFileTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        if (!validFileTypes.includes(file.type)) {
          alert("Por favor, selecione um arquivo JPG, PNG ou PDF.");
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
            $('#documento-identidade-uploaded').html('<a href="../uploads/' + res.fileName + '" target="_blank">Ver Documento de Identidade Enviado</a>');
            updateIcon('identidade-icon');
            updateViewButton('step-4', res.fileName);
            alert(res.message);
          },
          error: function (jqXHR, textStatus, errorThrown) {
            alert("Erro ao enviar o arquivo: " + textStatus);
          }
        });
      });

      $('#uploadButtonResidencia').click(function () {
        var fileInput = $('#comprovante-residencia')[0];
        if (fileInput.files.length === 0) {
          alert("Por favor, selecione um arquivo para enviar.");
          return;
        }
        var file = fileInput.files[0];
        var validFileTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        if (!validFileTypes.includes(file.type)) {
          alert("Por favor, selecione um arquivo JPG, PNG ou PDF.");
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
            $('#comprovante-residencia-uploaded').html('<a href="../uploads/' + res.fileName + '" target="_blank">Ver Comprovante de Residência Enviado</a>');
            updateIcon('residencia-icon');
            updateViewButton('step-5', res.fileName);
            alert(res.message);
          },
          error: function (jqXHR, textStatus, errorThrown) {
            alert("Erro ao enviar o arquivo: " + textStatus);
          }
        });
      });

      $('#uploadButtonLaudo').click(function () {
        var fileInput = $('#laudo-medico')[0];
        if (fileInput.files.length === 0) {
          alert("Por favor, selecione um arquivo para enviar.");
          return;
        }
        var file = fileInput.files[0];
        var validFileTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        if (!validFileTypes.includes(file.type)) {
          alert("Por favor, selecione um arquivo JPG, PNG ou PDF.");
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
            $('#laudo-medico-uploaded').html('<a href="../uploads/' + res.fileName + '" target="_blank">Ver Laudo Médico Enviado</a>');
            updateIcon('laudo-icon');
            updateViewButton('step-6', res.fileName);
            alert(res.message);
          },
          error: function (jqXHR, textStatus, errorThrown) {
            alert("Erro ao enviar o arquivo: " + textStatus);
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
      $(document).ready(function () {
    $('#generateCardButton').click(function () {
        // Verifica se todos os documentos foram enviados
        $.ajax({
            url: 'processamento/verificar_documentos.php',
            type: 'POST',
            data: { cod_pessoa: '<?php echo $cod_pessoa; ?>' },
            success: function (response) {
                var res = JSON.parse(response);
                if (res.allDocuments) {
                    // Todos os documentos foram enviados, gera a carteira
                    $.ajax({
                        url: 'processamento/gerar_carteira.php',
                        type: 'POST',
                        data: { cod_pessoa: '<?php echo $cod_pessoa; ?>' },
                        success: function (response) {
                            var res = JSON.parse(response);
                            if (res.success) {
                                alert("Carteira gerada com sucesso!");
                                // Redireciona para a página de carteirinha
                                window.location.href = 'carteirinha.php?cod_pessoa=<?php echo $cod_pessoa; ?>';
                            } else {
                                alert("Erro ao gerar a carteira: " + res.message);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert("Erro ao gerar a carteira: " + textStatus);
                        }
                    });
                } else {
                    alert("Por favor, envie todos os documentos obrigatórios antes de gerar a carteira.");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Erro ao verificar documentos: " + textStatus);
            }
        });
    });
});


        // Verifica se os documentos já existem para atualizar os ícones
        <?php if ($result_d5): ?>
        updateIcon('requerimento-icon');
        <?php endif; ?>
        <?php if ($result_d1): ?>
        updateIcon('foto-icon');
        <?php endif; ?>
        <?php if ($result_d4): ?>
        updateIcon('identidade-icon');
        <?php endif; ?>
        <?php if ($result_d3): ?>
        updateIcon('residencia-icon');
        <?php endif; ?>
        <?php if ($result_d2): ?>
        updateIcon('laudo-icon');
        <?php endif; ?>
    });
  </script>
</body>

</html>