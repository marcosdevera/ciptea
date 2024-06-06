<?php
if(isset($_GET['msg'])){
    if($_GET['msg'] == 1){
        echo "<script>alert('Usuário criado com sucesso! Acesse o sistema utilizando o Email e senha cadastrados durante o cadastro');</script>";
    }
    if($_GET['msg'] == 2){
        echo "<script>alert('Email ou senha incorretos, por favor, tente novamente');</script>";
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
</head>
<body>
    <div class="container">
        <h2>Tela de Cadastro e Login para o sistema CIPTEA</h2>
        <form action="processamento/processar_login.php" method="POST">
            <input type="text" name="login" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="submit" value="Logar">
        </form>
        <a href="cadastro_inicial.php"><input type="button" value="Não tem cadastro? Clique aqui"></a>
        <a href="recuperar_senha.php" style="margin-left: 4.5em;">Esqueci minha senha</a>
    </div>
</body>
</html>
