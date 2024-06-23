<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="images/imagemtopo.png" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            flex-direction: column;
        }

        .header-image {
            width: 100%;
            max-width: 400px;
            margin-bottom: 20px;
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
        input[type="password"],
        input[type="submit"],
        input[type="button"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        input[type="submit"],
        input[type="button"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #0056b3;
        }

        a {
            color: #007bff;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            width: 100%;
        }

        a:hover {
            text-decoration: underline;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #000000;
        }

        .alert {
            margin-top: 20px;
            color: red;
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
            input[type="password"],
            input[type="submit"],
            input[type="button"] {
                font-size: 14px;
            }

            .footer {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>CIPTEA</h2>
        <form action="processamento/processar_login.php" method="POST">
            <input type="text" name="login" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="submit" class="btn btn-primary" value="Logar">
        </form>
        <a href="cadastro_inicial.php"><input type="button" value="Não tem cadastro? Clique aqui"></a>
        <a href="recuperar_senha.php">Esqueci minha senha</a>
        <div class="footer">
            © 2024 Prefeitura de Camaçari
        </div>
        <!-- Se houver um erro, exibe a mensagem -->
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<div class="alert">Email ou senha incorretos.</div>';
        }
        ?>
    </div>
</body>
</html>
