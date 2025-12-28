<?php
namespace V1\Controllers;

use V1\Models\CheckIn;

class CheckInController
{
    public static function buscar($data)
    {
        CheckIn::search([],1);
    }
}
