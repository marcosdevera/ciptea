<?php
session_start();
include_once('classes/conexao.class.php');

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['access_key'])) {
    $access_key = $_POST['access_key'];

    // Conexão com o banco de dados
    $pdo = Database::conexao();
    $sql = "SELECT senha_hash FROM ciptea.dados_avaliador WHERE cod_avaliador = 5"; // Usando o cod_avaliador 5 para armazenar a senha
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && password_verify($access_key, $result['senha_hash'])) {
        $_SESSION['authorized'] = true;
        header('Location: cadastro_avaliadores.php');
        exit();
    } else {
        $erro = 'Senha inválida.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login com Chave de Acesso</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Acesso Restrito</h2>
        <form method="post">
            <div class="form-group">
                <label for="access_key">Chave de Acesso</label>
                <input type="password" name="access_key" id="access_key" class="form-control" required>
            </div>
            <?php if (isset($erro)): ?>
                <div class="alert alert-danger"><?php echo $erro; ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary btn-block">Acessar</button>
        </form>
    </div>
</body>
</html>
