<?php
namespace V1\Models;

class FichaExercicio extends \Crud
{
    protected static $table = "ficha_exercicio";

    public static function buscar($data)
    {
        self::search([],1);
    }
}
