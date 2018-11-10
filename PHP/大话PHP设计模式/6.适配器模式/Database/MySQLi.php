<?php

/**
 * Created by PhpStorm.
 * User: deali
 * Date: 11/23/2017 0023
 * Time: 15:30
 */
class MySQLi implements IDatabase
{
    protected $conn;

    function connect($host, $user, $passwd, $dbname)
    {
        // TODO: Implement connect() method.
        $conn = mysqli_connect($host, $user, $passwd, $dbname);
        $this->conn = $conn;
    }

    function query($sql)
    {
        // TODO: Implement query() method.
        $res = mysqli_query($this->conn, $sql);

        return $res;
    }

    function close()
    {
        // TODO: Implement close() method.
        mysqli_close($this->conn);
    }
}