<?php
define('ENCRYPTION_KEY', 'N2YxY2I4M2EwZjI1MTkxNjY2NmJhNzA5MDc4M2Y3OTg0Zjc3NzI3NGQ1OGNkMGM5NGM2NzE5MjEzMjYwNw=='); // Base64-encoded key
define('ENCRYPTION_METHOD', 'AES-256-CBC');

// Function to encrypt data
function encrypt($data) {
    $key = base64_decode(ENCRYPTION_KEY);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(ENCRYPTION_METHOD));
    $encrypted = openssl_encrypt($data, ENCRYPTION_METHOD, $key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}

// Function to decrypt data
function decrypt($data) {
    $key = base64_decode(ENCRYPTION_KEY);
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, ENCRYPTION_METHOD, $key, 0, $iv);
}
?>
