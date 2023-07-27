<?php

class DB {
    const HOST = "localhost";
    const USER = "root";
    const PASS = "";
    const DB = "test-task";

    public static function connToDB() {

        $host = self::HOST;
        $user = self::USER;
        $pass = self::PASS;
        $db = self::DB;

        $connection = new PDO("mysql:dbname=$db;host=$host;charset=UTF8", $user, $pass);
        return $connection;
        
    }
}