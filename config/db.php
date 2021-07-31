<?php
class Database
{
    public static function connect()
    {
        $db = new mysqli("localhost", "root", "", "tienda", 3308);
        $db->query("SET NAMES 'UTF8'");
        return $db;
    }
}
