<?php
if(isset($_GET['cod'])){
    // die ("Valor da url chegou");
    $cod_usuario = base64_decode($_GET['cod']); 
}
// echo "<script>alert('$cod_usuario');</script>";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        
        input[type="text"],
        input[type="password"] {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        
        input[type="submit"],
        input[type="button"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px; /* Adicionando margem entre os botões */
        }
        
        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #0056b3;
        } 
    </style>
    <script>
        function pegarCPF() {
        var cpfInput = document.getElementById('vch_cpf');
        cpfInput.value = formatarCPF(cpfInput.value);
        }

        function formatarCPF(cpf) {
        cpf = cpf.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o primeiro ponto
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o segundo ponto
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Adiciona o hífen
        return cpf;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Recuperação de senha</h2>
        <form action="processamento/processar_recuperacao.php" method="POST" onsubmit="return validarSenhas()">
            <input type="password" name="senha" id="senha" placeholder="Digite a nova senha" required minlength="8">
            <input type="password" name="confirmacao" id="confirmacao" placeholder="Confirme a senha" required minlength="8">
            <input type="checkbox" id="showPassword" style="margin-bottom: 10px;"> Mostrar senha 
            <input type="hidden" id="cod_usuario" name="cod_usuario" value="<?php echo $cod_usuario ?>">
            <input type="hidden" name="MM_action" id="MM_action" value="2">   
            <input type="submit" value="Enviar">
        </form>
    </div>
    <script>
        // Função para verificar se as senhas são iguais antes de enviar o formulário
        function validarSenhas() {
            var senha = document.getElementById("senha").value;
            var confirmacao = document.getElementById("confirmacao").value;

            // Verifica se as senhas são diferentes
            if (senha !== confirmacao) {
                alert("As senhas digitadas não são iguais. Para realizar a recuperação de senha é necessário que ambas as senhas abaixo sejam iguais.");
                return false; // Impede o envio do formulário
            }

            return true; // Permite o envio do formulário se as senhas forem iguais
        }

        document.getElementById('showPassword').addEventListener('change', function() {
            var senha = document.getElementById('senha');
            var confirmacao = document.getElementById('confirmacao');
            if (this.checked) {
                senha.type = 'text';
                confirmacao.type = 'text';
            } else {
                senha.type = 'password';
                confirmacao.type = 'password';
            }
        });
    </script>

</body>
</html>
