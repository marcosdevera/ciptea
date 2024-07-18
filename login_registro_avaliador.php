<?php
session_start();

function decrypt_key($encrypted_key, $encryption_key) {
    return openssl_decrypt($encrypted_key, 'AES-128-ECB', $encryption_key);
}

// Chave de criptografia (deve ser a mesma usada na geração)
$encryption_key = '762f7aac76768bca9d5edc200565f214f24b0c6070e0f304b333de2b092f909b';

// Função para validar a chave de acesso
function validar_chave($chave, $encryption_key) {
    $keys = json_decode(file_get_contents('keys.json'), true);
    $encrypted_key = $keys['access_key'];
    $decrypted_key = decrypt_key($encrypted_key, $encryption_key);
    return $chave === $decrypted_key;
}

// Verifica se a chave de acesso foi enviada
if (isset($_POST['access_key'])) {
    $access_key = $_POST['access_key'];
    if (validar_chave($access_key, $encryption_key)) {
        $_SESSION['authorized'] = true;
        header('Location: cadastro_avaliadores.php');
        exit();
    } else {
        $erro = 'Chave de acesso inválida.';
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
