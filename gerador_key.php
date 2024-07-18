<?php
function encrypt_key($key, $encryption_key) {
    return openssl_encrypt($key, 'AES-128-ECB', $encryption_key);
}

// Chave de acesso
$access_key = 'senha12345678';

// Chave de criptografia (deve ser mantida segura)
$encryption_key = '762f7aac76768bca9d5edc200565f214f24b0c6070e0f304b333de2b092f909b';

// Criptografa a chave de acesso
$encrypted_key = encrypt_key($access_key, $encryption_key);

// Armazena a chave criptografada em um arquivo JSON
$keys = ['access_key' => $encrypted_key];
file_put_contents('keys.json', json_encode($keys, JSON_PRETTY_PRINT));

echo "Chave de acesso gerada e armazenada com sucesso.\n";
?>
