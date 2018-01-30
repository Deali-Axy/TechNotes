<?php

/**
 * Created by PhpStorm.
 * User: deali
 * Date: 11/23/2017 0023
 * Time: 15:19
 */
class Register
{
    protected static $objects;


    static function set($alias, $object)
    {
        self::$objects[$alias] = $object;
    }

    static function get($alias)
    {
        return self::$objects[$alias];
    }

    function _unset($alias)
    {
        unset(self::$objects[$alias]);
    }
}


//从注册树中获取对象
$db=Register::get("db1");