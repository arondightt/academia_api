<?php
namespace V1\Controllers;

use V1\Models\Ficha;

class FichaController
{
    public static function buscar($data)
    {
        Ficha::search([],1);
    }
}
