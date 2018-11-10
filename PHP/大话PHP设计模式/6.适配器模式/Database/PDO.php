<?php

/**
 * Created by PhpStorm.
 * User: deali
 * Date: 11/23/2017 0023
 * Time: 15:30
 */
class PDO implements IDatabase
{
    protected $conn;

    function connect($host, $user, $passwd, $dbname)
    {
        // TODO: Implement connect() method.
        $conn = new \PDO("mysql:host=$host;dbname=$dbname", $user, $passwd);
        $this->conn = $conn;

    }

    function query($sql)
    {
        // TODO: Implement query() method.
        return $this->conn->query($sql);
    }

    function close()
    {
        // TODO: Implement close() method.
        unset($this->conn);
    }
}