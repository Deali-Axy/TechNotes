<?php

/**
 * Created by PhpStorm.
 * User: deali
 * Date: 11/23/2017 0023
 * Time: 15:30
 */

class MySQL implements IDatabase
{
    protected $conn;

    function connect($host, $user, $passwd, $dbname)
    {
        // TODO: Implement connect() method.
        $conn = mysql_connect($host, $user, $passwd);
        mysql_select_db($conn, $dbname);
        $this->conn = $conn;
    }

    function query($sql)
    {
        // TODO: Implement query() method.
        $res = mysql_query($sql, $this->conn);

        return $res;
    }

    function close()
    {
        // TODO: Implement close() method.
        mysql_close($this->conn);
    }
}