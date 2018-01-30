<?php
/**
 * Created by PhpStorm.
 * User: DealiAxy
 * Date: 2017-08-10
 * Time: 20:57
 */

//注册类自动载入器
spl_autoload_register("");

Test1\test1();

function autoload1($class){
    require __DIR__.'/'.$class.'.php';
}