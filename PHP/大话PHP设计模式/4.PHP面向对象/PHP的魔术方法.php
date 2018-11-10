<?php
/**
 * Created by PhpStorm.
 * User: DealiAxy
 * Date: 2017-08-11
 * Time: 09:52
 */

/**
 * PHP魔术方法
 * 1.__get/__set  对象属性，调用不存在的属性时会自动生成赋值
 * 2.__call/__callStatic  控制对象的方法调用，调用不存在的方法时
 * 3.__toString
 * 4.__invoke  将对象当成函数执行时
 */

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

    function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        var_dump($name,$arguments);
        return "magic function";
    }

    static function __callStatic($name, $arguments)
    {
        // TODO: Implement __callStatic() method.
        var_dump($name,$arguments);
        return "static magic function";
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return __CLASS__;
    }

    //将类对象当成函数执行时自动调用这个方法
    //参数就相当于函数的参数
    function __invoke($param)
    {
        // TODO: Implement __invoke() method.
        var_dump($param);
        return "invoke";
    }
}

$obj = new ObjectClass();

//调用一个不存在的属性
$obj->title = "hello";
echo $obj->title;