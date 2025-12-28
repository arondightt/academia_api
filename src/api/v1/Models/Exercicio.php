<?php
namespace V1\Models;

class Exercicio extends \Crud
{
    protected static $table = "exercicio";

    public static function buscar($data)
    {
        self::search([],1);
    }
}
