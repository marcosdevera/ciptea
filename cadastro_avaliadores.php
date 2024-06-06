<?php
    include_once ("classes/avaliador.class.php");

    $a = new Avaliador();
    $result_avaliador = $a->exibirAvaliadores();
    $count_avaliador = $result_avaliador->rowCount(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de avaliadores</title>
      <!-- Custom styles for this template -->
  <link href="css/menu-lateral.css" rel="stylesheet">

<!-- Bootstrap e dependências -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/formValidation.css">
<link rel="stylesheet" href="css/loading.css">
<link rel="stylesheet" href="css/bootstrap-combobox.css">
<link rel="stylesheet" href="css/custom.css">

<!-- Bootstrap core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto; /* Centralizar o formulário */
        }
        input[type="text"], input[type="date"], input[type="number"], input[type="password"], input[type="submit"], select, input[type="file"] {
            width: calc(100% - 15px); /* Reduzindo o tamanho dos componentes */
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%; /* Ajustando o botão de envio */
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .representante_legal {
            display: none;
            padding-top: 10px;
        }
        label {
            display: block;
            margin-bottom: 5px; /* Espaçamento entre os labels */
        }
    </style>

    <script>
        function formatarCPF(inputId) {
            var cpfInput = document.getElementById(inputId);
            cpfInput.value = formatCPF(cpfInput.value);
        }

        function formatCPF(cpf) {
            cpf = cpf.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o primeiro ponto
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o segundo ponto
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Adiciona o hífen
            return cpf;
        }
    </script>

</head>
<body>
    <form name="form" action="processamento/processar_avaliador.php" method="POST" enctype="multipart/form-data">
        <h2>Cadastro de avaliadores:</h2>
        <label for="vch_avaliador">Nome do avaliador:</label>
        <input type="text" name="vch_avaliador" id="vch_avaliador" required> 
        <label for="vch_cpf_avaliador">CPF do avaliador:</label>
        <input type="text" name="vch_cpf_avaliador" id="vch_cpf_avaliador" oninput="formatarCPF('vch_cpf_avaliador')" maxlength="14" required>    
        <label for="vch_login">Login:</label>
        <input type="text" name="vch_login" id="vch_login" required>
        <label for="vch_senha">Senha (mínimo de 8 caracteres):</label>
        <input type="password" name="vch_senha" id="vch_senha" minlength="8" required>
        <input type="checkbox" id="showPassword" value=""> Mostrar senha            
        <input type="hidden" name="MM_action" class="MM_action" value="1">
        <input type="submit" value="Cadastrar">
    </form>
    
    <?php if($count_avaliador != 0){ ?>
        <table class="table table-striped table-bordered" style="margin-top:10px;">
          <thead>
            <tr>
              <th>Nome do avaliador</th>
              <th>CPF</th>
              <th>Login</th>
            </tr>
          </thead>

          <tbody>
          <?php 
            while($row_avaliador = $result_avaliador->fetch(PDO::FETCH_ASSOC))
            { ?>
              <tr>
                <td><?php echo $row_avaliador["vch_avaliador"]; ?></td> 
                  <td><?php echo $row_avaliador["vch_cpf_avaliador"]; ?></td> 
                  <td><?php echo $row_avaliador["vch_login"]; ?></td> 
                </tr>
                  <?php 
            } ?>
          </tbody>
        </table>
    <?php } ?>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('showPassword').addEventListener('change', function() {
            var passwordField = document.getElementById('vch_senha');
            if (this.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>
</body>
</html>