<?php

namespace api\DB_Connection;

use Exception;
use PDO;
use PDOException;

class DBConn
{
    private static $conn = null;

    public static function get_connection () : PDO {

        if(self::$conn === null){
            self::connect();
        }
        return self::$conn;
    }

    private static function connect() : void {
        $host = getenv("MYSQL_HOST");
        $DataBase = getenv("MYSQL_DATABASE");
        $UserName = getenv("MYSQL_USER");
        $UserPasword = getenv("MYSQL_PASSWORD");

        try {
            self::$conn = new PDO("mysql:host=".$host . ";dbname=" . $DataBase, $UserName, $UserPasword);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            throw new Exception('Failed to connect to the database: ' . $e->getMessage());
        }
    }

    public static function close_conn () {
        self::$conn = null;
    }

}