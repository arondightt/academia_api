<?php
namespace V1\Controllers;

use V1\Models\Aluno;

class AlunoController
{
    public static function buscar($data)
    {
        Aluno::search([],1);
    }
}
