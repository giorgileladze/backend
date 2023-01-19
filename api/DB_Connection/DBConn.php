<?php

namespace api\DB_Connection;

use Exception;
use PDO;
use PDOException;

class DBConn
{
    private static string $host = "localhost";
    private static string $DataBase = "scand_product_crud";
    private static string $UserName = "root";
    private static string $UserPasword = "giorgi123";

    private static $conn = null;


    public static function get_connection () {
        if(self::$conn === null){
            self::$conn = self::connect();
        }
        return self::$conn;

    }

    private static function connect() {
        self::$conn = null;

        try {
            self::$conn = new PDO("mysql:host=".self::$host . ";dbname=" . self::$DataBase, self::$UserName, self::$UserPasword);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            throw new Exception('Failed to connect to the database: ' . $e->getMessage());
        }

        return self::$conn;
    }

    public static function close_conn () {
        self::$conn = null;
    }

}