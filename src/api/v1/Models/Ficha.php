<?php
namespace V1\Models;

class Ficha extends \Crud
{
    protected static $table = "ficha";

    public static function buscar($data)
    {
        self::search([],1);
    }
}
