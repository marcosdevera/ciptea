<?php
if(isset($_GET['msg'])){
    if($_GET['msg'] == 1){
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
    <title>Recuperação de Senha</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="images/imagemtopo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'shogie';
            src: url('css/fonts/Shogie.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            background: url('images/background_login2.webp') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            margin: auto;
            text-align: center;
        }

        h2 {
            font-family: 'shogie', sans-serif;
            font-size: 2.8em;
            color: #007bff;
            margin: 0 0 20px 0;
        }

        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #000;
            text-align: center;
        }

        @media (max-width: 767px) {
            .container {
                padding: 15px;
                max-width: 90%;
            }

            h2 {
                font-size: 2.2em;
            }

            input[type="text"],
            input[type="submit"] {
                font-size: 14px;
            }
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
        <h2>Recuperação de Senha</h2>
        <form action="processamento/processar_recuperacao.php" method="POST">
            <input type="text" name="vch_cpf" id="vch_cpf" oninput="pegarCPF()" placeholder="Digite o CPF cadastrado" required>
            <input type="hidden" name="MM_action" id="MM_action" value="1"> 
            <input type="submit" value="Enviar">
        </form>
        <div class="footer">
            © 2024 Prefeitura de Camaçari
        </div>
    </div>
</body>
</html>
