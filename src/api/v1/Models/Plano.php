<?php
namespace V1\Models;

class Plano extends \Crud
{
    protected static $table = "plano";

    public static function buscar($data)
    {
        self::search([],1);
    }
}
