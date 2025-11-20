<?php

$recaptcha_response = $_POST['g-recaptcha-response'] ?? null;

$env = parse_ini_file('.env');
$secret = $env['RECAPTCHA_SECRET_KEY'] ?? null;

if (empty($recaptcha_response) || empty($secret)) {
    echo json_encode([
        'error'   => true,
        'message' => 'Token não informado'
    ], JSON_PRETTY_PRINT);

    return;
}

// 1. Define a URL
$url = 'https://www.google.com/recaptcha/api/siteverify';

// 2. Define os dados a serem enviados (pode ser uma string ou um array)
$data = [
    'secret'   => $secret,
    'response' => $recaptcha_response
];

try {
    // 3. Inicializa a sessão cURL
    $curl = curl_init();
    
    // 4. Define as opções do cURL
    curl_setopt($curl, CURLOPT_URL, $url); // Define a URL
    curl_setopt($curl, CURLOPT_POST, true); // Define o método como POST
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data)); // Define os dados do POST
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Retorna a resposta como uma string
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

    // 5. Executa a requisição cURL
    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        throw new Exception(curl_error($curl));
    }

    $response = json_decode($response, true);
} catch (Exception $e) {
    $response = [
        'error'   => true,
        'message' => $e->getMessage()
    ];
}

// 6. Exibe a resposta
echo json_encode($response);