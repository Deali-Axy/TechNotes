<?php
/**
 * Created by PhpStorm.
 * User: deali
 * Date: 11/23/2017 0023
 * Time: 14:54
 */

//固定长度数组

$array=new SplFixedArray(10);

$array[0]=123;
$array[9]=1234;

var_dump($array);