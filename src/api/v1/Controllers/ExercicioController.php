<?php
namespace V1\Controllers;

use V1\Models\Exercicio;

class ExercicioController
{
    public static function buscar($data)
    {
        Exercicio::search([],1);
    }
}
