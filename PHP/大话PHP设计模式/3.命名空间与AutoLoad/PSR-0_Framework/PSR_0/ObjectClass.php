<?php
/**
 * Created by PhpStorm.
 * User: DealiAxy
 * Date: 2017-08-10
 * Time: 21:27
 */

namespace PSR_0;

class ObjectClass
{
    protected $array = array();

    static function test()
    {
        echo "ObjectClass test";
    }

    //调用不存在的属性时自动调用这两个方法
    function __set($key, $value)
    {
        $this->array[$key] = $value;
    }

    function __get($key)
    {
        return $this->array[$key];
    }
}