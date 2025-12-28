<?php
namespace V1\Controllers;

use V1\Models\FichaExercicio;

class FichaExercicioController
{
    public static function buscar($data)
    {
        FichaExercicio::search([],1);
    }
}
