<?php
/**
 * Created by PhpStorm.
 * User: DealiAxy
 * Date: 2017-08-10
 * Time: 21:31
 */

define('BASEDIR',__DIR__);

include BASEDIR.'/PSR_0/Loader.php';
spl_autoload_register("\\PSR_0\\Loader::autoload");

PSR_0\ObjectClass::test();

App\Controller\Home\Index::test();