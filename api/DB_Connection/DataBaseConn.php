<?php

namespace api\DB_Connection;

use api\src\products\model\Product;
use Exception;
use PDO;
use PDOException;

class DataBaseConn {
    private string $host = "localhost";
    private string $DataBase = "scand_product_crud";
    private string $UserName = "root";
    private string $UserPasword = "giorgi123";

    private $conn = null;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->DataBase", $this->UserName, $this->UserPasword);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            throw new Exception('Failed to connect to the database: ' . $e->getMessage());
        }

        return $this->conn;
    }

    public function insert (Product $product) {
        $data = $product->get_properties();
        $table = $product::TABLE_NAME;

        $columns = implode(",", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);
        } catch (PDOException $e) {
            throw new Exception('Failed to insert to the table: ' . $e->getMessage());
        }
    }

    public function select (string $table) : array {
        $sql = "SELECT * FROM $table ORDER BY SKU";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

//    private function check_sku (array $sku) : bool {
//       $this->select()
//    }

    public function delete_by_sku (array $array) : string {
        $items_to_delete = "('" . implode("','", array_values($array)) . "')";
        $sql = "
            DELETE FROM book WHERE SKU IN ($items_to_delete);
            DELETE FROM DVD WHERE SKU IN ($items_to_delete);
            DELETE FROM furniture WHERE SKU IN ($items_to_delete);
        ";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e){
            http_response_code(500);
            return 0;
        }
    }

    public function close_conn () {
        $this->conn = null;
    }


}