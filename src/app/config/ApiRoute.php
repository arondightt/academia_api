<?php

class ApiRoute  extends Crud
{
    protected static string $table = 'api_route';

    public static function validadeApiRoute($data)
    {
        $endpoint = self::normalizeEndpoint($data['endpoint']);

        $sql['where'] = ["endpoint_request = ? AND method_http = ? AND endpoint_status = ? AND api_version = ?","{$endpoint}", $data['method_http'], 1, $data['version']];
        $return = self::search($sql);
        return $return;
    }

    private static function normalizeEndpoint($endpoint)
    {
        $parts = explode('/', trim($endpoint, '/'));

        foreach ($parts as &$part) {
            if (ctype_digit($part)) {
                $part = ':id';
            }
        }

        return implode('/', $parts);
    }
}
