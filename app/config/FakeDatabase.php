<?php

namespace App\Config;

class FakeDatabase
{
    private static $tabela = '';

    public function __construct($tabela = '')
    {
        self::$tabela = $tabela;
    }

    public static function getFakeData()
    {
        $tabela = self::$tabela;
        $path = dirname(__DIR__, 2) . "/database-mock/{$tabela}.json";
        if (file_exists($path)) {
            $content = file_get_contents($path);
            return json_decode($content, true);
        }
        return ["error" => "Tabela de dados não encontrada"];
    }

}