<?php

/**
 * Created by PhpStorm.
 * User: DealiAxy
 * Date: 2017-08-11
 * Time: 09:39
 */
class DataBase
{
    function where($where)
    {
        //实现链式操作的关键
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

$db = new DataBase();

//没有链式操作
$db->where("id=1");
$db->where("name=2");
$db->order("id desc");
$db->limit(10);


//PHP链式操作实现
$db->where("id=1")->where("name=2")->limit("id desc")->order(10);