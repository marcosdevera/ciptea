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
    <!-- <link rel="stylesheet" href="css/style.css"> -->

    <title>Login</title>
    <style>
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
        margin-bottom: 10px;  /*Adicionando margem entre os botões*/ 
    } 
    body {
    background-image: url('images/background_login2.webp'); /* Certifique-se de que o caminho para a imagem está correto */
    background-size: cover;
    background-position: center; /* Centraliza a imagem de fundo */
    height: 100vh; /* Ocupa a altura total da janela */
    margin: 0; /* Remove margens padrão */
    padding: 0; /* Remove preenchimento padrão */
    display: flex;
    justify-content: center; /* Centraliza horizontalmente */
    align-items: center; /* Centraliza verticalmente */
    font-family: Arial, sans-serif;
    background-color: #f0f0f0; /* Cor de fundo se a imagem não carregar */
}

.container {
    background-color: rgba(255, 255, 255, 0.9); /* Fundo branco semi-transparente */
    padding: 20px; /* Espaço interno */
    border-radius: 8px; /* Bordas arredondadas */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra leve */
    max-width: 800px; /* Aumentar a largura máxima para 800px */
    width: 80%; /* Permitir que o contêiner ocupe 80% da largura disponível */
    margin: 0 auto; /* Centraliza horizontalmente */
}

@font-face {
    font-family: 'shogie';
    src: url('css/fonts/Shogie.otf') format('opentype'); /* Certifique-se de que o caminho para a fonte está correto */
    font-weight: normal;
    font-style: normal;
}

h2 {
    font-family: 'shogie', sans-serif; /* Certifique-se de que a fonte 'shogie' está carregada */
    font-size: 2.8em;
    color: #5800ff; /* Cor do texto */
    text-align: center; /* Centraliza o texto */
    margin: 0; /* Remove margens padrão */
    padding-bottom: 20px; /* Espaço abaixo do título */
}

input[type="text"],
input[type="password"] {
    width: calc(100% - 16px); /* Ajusta a largura para caber no contêiner com um pouco de margem */
    padding: 10px; /* Espaço interno */
    margin-bottom: 10px; /* Espaço inferior entre os campos */
    border-radius: 4px; /* Bordas arredondadas */
    border: 1px solid #ccc; /* Borda dos campos */
}

input[type="submit"],
input[type="button"] {
    width: 100%; /* Botão ocupa toda a largura do contêiner */
    padding: 10px; /* Espaço interno */
    background-color: #007bff; /* Cor de fundo padrão do botão */
    color: white; /* Cor do texto */
    border: none; /* Remove borda */
    border-radius: 4px; /* Bordas arredondadas */
    cursor: pointer; /* Cursor muda ao passar o mouse */
}

input[type="submit"]:hover,
input[type="button"]:hover {
    background-color: #0056b3; /* Cor de fundo ao passar o mouse */
}

a {
    color: #007bff; /* Cor do link */
    text-decoration: none; /* Remove sublinhado padrão */
}

a:hover {
    text-decoration: underline; /* Adiciona sublinhado ao passar o mouse */
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
        <a href="recuperar_senha.php" style="margin-left: 13.5em;">Esqueci minha senha</a>
    </div>
</body>
</html>
