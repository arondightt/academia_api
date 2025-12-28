<?php
namespace V1\Controllers;

use V1\Models\Plano;

class PlanoController
{
    public static function buscar($data)
    {
        Plano::search([],1);
    }
}
