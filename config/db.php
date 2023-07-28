<?php

class DB 
{
    const HOST = "localhost";
    const USER = "root";
    const PASS = "";
    const DB = "test-task";

    public static function connToDatabase() 
    {
        $host = self::HOST;
        $user = self::USER;
        $pass = self::PASS;
        $db = self::DB;

        return new PDO("mysql:dbname=$db;host=$host;charset=UTF8", $user, $pass); 
    }
}