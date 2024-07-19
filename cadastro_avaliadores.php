<?php
session_start();

if (!isset($_SESSION['authorized']) || !$_SESSION['authorized']) {
    header('Location: login_registro_avaliador.php');
    exit();
}

include_once("classes/avaliador.class.php");

$a = new Avaliador();
$result_avaliador = $a->exibirAvaliadores();
$count_avaliador = $result_avaliador->rowCount();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de avaliadores</title>
    
    <!-- Bootstrap e dependências -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/formValidation.css">
    <link rel="stylesheet" href="css/loading.css">
    <link rel="stylesheet" href="css/bootstrap-combobox.css">
    <link rel="stylesheet" href="css/custom.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="password"], input[type="submit"], select, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .table {
            margin-top: 20px;
        }
        .toggle-password {
            margin-top: 10px;
        }
        .alert {
            margin-top: 20px;
        }
        .logout-btn {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
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
    <div class="container form-container">
        <form name="form" action="processamento/processar_avaliador.php" method="POST" enctype="multipart/form-data">
            <h2 class="text-center">Cadastro de Avaliadores</h2>
            <label for="vch_avaliador">Nome do Avaliador:</label>
            <input type="text" name="vch_avaliador" id="vch_avaliador" required> 
            <label for="vch_cpf_avaliador">CPF do Avaliador:</label>
            <input type="text" name="vch_cpf_avaliador" id="vch_cpf_avaliador" oninput="formatarCPF('vch_cpf_avaliador')" maxlength="14" required>    
            <label for="vch_login">Login:</label>
            <input type="text" name="vch_login" id="vch_login" required>
            <label for="vch_senha">Senha (mínimo de 8 caracteres):</label>
            <input type="password" name="vch_senha" id="vch_senha" minlength="8" required>
            <div class="toggle-password">
                <input type="checkbox" id="showPassword"> Mostrar senha            
            </div>
            <input type="hidden" name="MM_action" class="MM_action" value="1">
            <input type="submit" value="Cadastrar">
        </form>
        
        <?php if($count_avaliador != 0){ ?>
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Nome do Avaliador</th>
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

        <div class="logout-btn">
            <form action="processamento/logout.php" method="POST">
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
    
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
