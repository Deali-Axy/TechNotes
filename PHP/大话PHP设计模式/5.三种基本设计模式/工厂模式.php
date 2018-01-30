<?php

/**
 * Created by PhpStorm.
 * User: deali
 * Date: 11/23/2017 0023
 * Time: 15:12
 */

include "database.php";

class Factory
{
    //创建database的对象
    static function createDatabase()
    {
        $db = new Database();

        return $db;
    }
}