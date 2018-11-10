<?php

/**
 * Created by PhpStorm.
 * User: deali
 * Date: 11/23/2017 0023
 * Time: 14:57
 */


class Database
{
    function where($where)
    {
        //返回本身对象以实现链式操作
        return $this;
    }

    function order($order)
    {
        return $this;
    }

    function limit($limit)
    {
        return $this;
    }
}