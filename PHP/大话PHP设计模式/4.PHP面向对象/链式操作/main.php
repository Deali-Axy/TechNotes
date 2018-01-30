<?php
/**
 * Created by PhpStorm.
 * User: deali
 * Date: 11/23/2017 0023
 * Time: 14:56
 */

//实现链式操作

$db=new Database();
$db->where("id=1")->where("name=2")->order("id desc")->limit(10);