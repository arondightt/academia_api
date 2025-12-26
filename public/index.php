<?php
require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/app/config/Routers.php';
use App\Config\Routers;

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$data = $_GET ?? "";

if ($method != 'GET') {
    $inputJSON = file_get_contents('php://input');
    $data = json_decode($inputJSON, true);
}

Routers::dispatch($method, $uri, $data);
