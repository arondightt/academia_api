<?php
namespace V1\Controllers;

use V1\Models\Matricula;

class MatriculaController
{
    public static function buscar($data)
    {
        Matricula::search([],1);
    }
}
