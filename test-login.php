<?php

require __DIR__.'/vendor/autoload.php';

$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://127.0.0.1:8004',
    'headers' => [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ],
]);

try {
    $response = $client->post('/api/login', [
        'json' => [
            'email' => 'admin@example.com',
            'password' => 'password',
        ],
        'http_errors' => false,
    ]);

    echo "Status Code: " . $response->getStatusCode() . "\n";
    echo "Response Body: " . $response->getBody() . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
