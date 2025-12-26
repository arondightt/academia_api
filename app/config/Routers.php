<?php

Namespace App\Config;
require_once __DIR__ . "/FakeDatabase.php";
use App\Config\FakeDatabase;

class Routers 
{
    private static $routes = [];
    public static $endpoint = '';
    public static $version = '';

    public static function dispatch($method = null, $uri = null, $data = null) 
    {
        $uri = trim($uri, "/");
        $uriArray = explode("/", $uri);

        if (!str_starts_with($uriArray[0], 'v')) {
            http_response_code(404);
            return ['error' => ["message" => "Versão da API não informada"]];
        }

        self::$version = $uriArray[0];
        self::$endpoint = $uriArray[1];
        $arrayAcessApi = self::loadRoutes();
        echo '<pre>';
        print_r($arrayAcessApi);
        die();
        return;
        foreach (self::$routes as $route) {
            if ($route['method'] === $method && $route['path'] === $uri) {
                call_user_func($route['callback']);
                return;
            }
        }
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint não encontrado']);
    }

    private static function loadRoutes() 
    {
        $dataFake = new FakeDatabase('endpoints');
        $endpoints = $dataFake->getFakeData();

        if (isset($endpoints['error'])) {
            http_response_code(500);
            echo json_encode(['error' => ["message" => "Erro ao carregar endpoints"]]);
            return;
        }

        $return = $endpoints[self::$endpoint] ?? ['error' => ["message" => "Endpoint não encontrado"]];

        return self::$routes = $return;

    }
}