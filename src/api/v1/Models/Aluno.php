<?php
namespace V1\Models;

class Aluno extends \Crud
{
    protected static $table = "aluno";

    public static function buscar($data)
    {
        self::search([],1);
    }
}
