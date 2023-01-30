<?php

namespace api\DB_Connection;

use Exception;
use PDO;
use PDOException;

class DBConn
{
    private static string $host = "mysql";
    private static string $DataBase = "scand";
    private static string $UserName = "root";
    private static string $UserPasword = "password";

    private static $conn = null;

    public static function get_connection () {

        if(self::$conn === null){
            self::connect();
        }
        return self::$conn;
    }

    private static function connect() : void {
        try {
            self::$conn = new PDO("mysql:host=".self::$host . ";dbname=" . self::$DataBase, self::$UserName, self::$UserPasword);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            throw new Exception('Failed to connect to the database: ' . $e->getMessage());
        }
    }

    public static function close_conn () {
        self::$conn = null;
    }

}