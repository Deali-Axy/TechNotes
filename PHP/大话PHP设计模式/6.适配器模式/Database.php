<?php

/**
 * Created by PhpStorm.
 * User: deali
 * Date: 11/23/2017 0023
 * Time: 15:28
 */
include "Database/MySQL.php";
include "Database/MySQLi.php";
include "Database/PDO.php";

interface IDatabase
{
    function connect($host, $user, $passwd, $dbname);

    function query($sql);

    function close();
}