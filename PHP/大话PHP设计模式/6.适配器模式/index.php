<?php
/**
 * Created by PhpStorm.
 * User: deali
 * Date: 11/23/2017 0023
 * Time: 15:27
 */

include "Database.php";

$db = new MySQL();
$db->connect("127.0.0.1", "root", "root", "test");
$db->query("show database");
$db->close();