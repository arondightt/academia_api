<?php
namespace V1\Models;

class AvaliacaoFisica extends \Crud
{
    protected static $table = "avaliacao_fisica";

    public static function buscar($data)
    {
        self::search([],1);
    }
}
