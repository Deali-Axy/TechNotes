<?php

/**
 * Created by PhpStorm.
 * User: deali
 * Date: 11/23/2017 0023
 * Time: 15:14
 */
class Database
{
    static $db;

    private function __construct()
    {

    }

    static function getInstance()
    {
        if (self::$db)
            return self::$db;
        else
        {
            self::$db = new self();

            return self::$db;
        }

    }
}


//$db=new Database(); //无法调用的，因为database的构造函数是私有的，不能被调用
//要获取database对象只能通过：
$db=Database::getInstance();
