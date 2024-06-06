<?php
if(isset($_GET['msg'])){
    if($_GET['msg'] == 1){
        // die ("Valor da url chegou");
        $login_dec = base64_decode($_GET['login']);

        // Mascarar o email
        $email = $login_dec;
        $email_parts = explode('@', $email); // Dividir o email em duas partes: nome de usuário e domínio

        if (count($email_parts) === 2) {
            $username = $email_parts[0];
            $domain = $email_parts[1];

            // Obter os primeiros dois caracteres do nome de usuário e os dois últimos caracteres
            $masked_username = substr($username, 0, 2) . str_repeat('*', strlen($username) - 4) . substr($username, -2);

            // Reconstruir o email mascarado
            $masked_email = $masked_username . '@' . $domain;

            $mensagemAlerta = "Um email foi enviado para $masked_email";

            // Exibir o alerta com o email mascarado
            echo "<script>alert('$mensagemAlerta');</script>";
        } else {
            // Tratar caso o email não esteja no formato esperado
            echo "<script>alert('Formato de email inválido');</script>";
        }
    }
}
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
        <form action="processamento/processar_recuperacao.php" method="POST">
            <input type="text" name="vch_cpf" id="vch_cpf" oninput="pegarCPF()" placeholder="Digite o CPF cadastrado" required>
            <input type="hidden" name="MM_action" id="MM_action" value="1"> 
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>
