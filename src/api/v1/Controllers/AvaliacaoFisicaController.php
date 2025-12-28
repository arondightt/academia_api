<?php
namespace V1\Controllers;

use V1\Models\AvaliacaoFisica;

class AvaliacaoFisicaController
{
    public static function buscar($data)
    {
        AvaliacaoFisica::search([],1);
    }
}
