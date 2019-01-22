<?php

namespace App\Classes;


class Database
{
    private static $conn;


    private function __construct()
    {
        $dhs = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
        $options = [
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ];

        try {
            self::$conn = new \PDO($dhs, DB_USER, DB_PASS, $options);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getConn()
    {
        if (self::$conn == null) {
            new Database();
        }
        return self::$conn;
    }

}