<?php
namespace V1\Models;

class CheckIn extends \Crud
{
    protected static $table = "checkin";

    public static function buscar($data)
    {
        self::search([],1);
    }
}
