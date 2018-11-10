<?php
/**
 * 框架系统自动载入器
 * User: DealiAxy
 * Date: 2017-08-10
 * Time: 21:32
 */

namespace PSR_0;

class  Loader
{
    /**
     * @param $class string 包含命名空间和类名的字符串
     */
    static function autoload($class)
    {
        require BASEDIR."/".str_replace("\\","/",$class).".php";
    }
}