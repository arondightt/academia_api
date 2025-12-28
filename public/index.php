<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/app/config/Crud.php';
require_once dirname(__DIR__) . '/app/config/ApiRoute.php';
require_once dirname(__DIR__) . '/app/config/Routers.php';
require_once dirname(__DIR__) . '/app/config/Response.php';
require_once dirname(__DIR__) . '/app/helpers.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$data = $_GET ?? "";

if ($method != 'GET') {
    $inputJSON = file_get_contents('php://input');
    $data = json_decode($inputJSON, true);
}

Routers::$method($uri, $data);
