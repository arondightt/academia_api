<?php

class Routers 
{
    private static $routes = [];
    public static $endpoint = '';
    public static $version = '';

    public static function dispatch($data = null)
    {
        $classMethod = self::loadRoutes();

        $className  = "V1\\Controllers\\" . $classMethod['class'];
        $methodName = $classMethod['method'];

        if (!class_exists($className)) {
            return Response::send(500, ['error' => 'Controller não encontrado']);
        }

        if (!is_callable([$className, $methodName])) {
            return Response::send(500, ['error' => 'Método inválido']);
        }

        return $className::$methodName($data);
    }



    private static function loadRoutes() 
    {
        $endpoint = self::$routes['endpoint'] ?? null;
        $method   = self::$routes['method'] ?? null;

        $data = [
            'endpoint' => self::$routes['endpoint'],
            'version' => self::$version,
            'method_http'=> self::$routes['method']

        ];
        if (!$endpoint || !$method) {
            return Response::send(400,['message' => ["error" => "Endpoint ou método não informado"]]);
        }

        $endpoints = ApiRoute::validadeApiRoute($data); 

        if (isset($endpoints['error'])) {
            return Response::send(400,['error' => ["message" => "Erro ao carregar endpoints"]]);
        }

        if (empty($endpoints)) {
            return Response::send(500,['error' => ["message" => "Endpoint não encontrado"]]);
        }

        $classMethod = explode("@", $endpoints[0]['class_method']);

       return [
        "class" => $classMethod[0],
        "method" => $classMethod[1]
       ];

    }


    public static function get($uri, $data = null)
    {
        $endpoint = self::validateVersionEndpoint($uri);
        self::$routes = [
            "method" => "GET",
            "endpoint" => $endpoint
        ];
        return self::dispatch($data);

    }

    public static function post($uri, $data = null)
    {
        $endpoint = self::validateVersionEndpoint($uri);
        self::$routes = [
            "method" => "POST",
            "endpoint" => $endpoint
        ];
        return self::dispatch($data);
    }

    public static function put($uri, $data = null)
    {
        $endpoint = self::validateVersionEndpoint($uri);
        self::$routes = [
            "method" => "PUT",
            "endpoint" => $endpoint
        ];
        return self::dispatch($data);
    }

    public static function patch($uri, $data = null)
    {
        $endpoint = self::validateVersionEndpoint($uri);
        self::$routes = [
            "method" => "PATCH",
            "endpoint" => $endpoint
        ];
        return self::dispatch($data);
    }

    public static function delete($uri, $data = null)
    {
        $endpoint = self::validateVersionEndpoint($uri);
        self::$routes = [
            "method" => "DELETE",
            "endpoint" => $endpoint
        ];
        return self::dispatch($data);
    }

    public static function validateVersionEndpoint($data)
    {
        $uri = trim($data, "/");
        $uriArray = explode("/", $uri);

        if (!str_starts_with($uriArray[0], 'v')) {
            http_response_code(404);
            return ['error' => ["message" => "Versão da API não informada"]];
        }

        self::$version = $uriArray[0];
        unset($uriArray[0]);
        
        return  implode("/", $uriArray);
    }

}