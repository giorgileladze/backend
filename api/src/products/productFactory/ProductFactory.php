<?php

namespace api\src\products\productFactory;

use api\src\products\model\Product;
use api\src\products\productTypes\Book;
use api\src\products\productTypes\DVD;
use api\src\products\productTypes\Furniture;

class ProductFactory {
    private static ?ProductFactory $product_factory_object = null;

    private function __construct ()
    {
    }
    public static function get_product_factory_object () : self{
        if(self::$product_factory_object == null){
            self::$product_factory_object = new ProductFactory();
        }

        return self::$product_factory_object;
    }

    public function create_product ($data) : Product {
        $product = null;

        if($data["productType"] == "DVD"){
            $product = new DVD($data["SKU"], $data["name"], $data["price"], $data["size"]);
        } else if($data["productType"] == "Book"){
            $product = new Book($data["SKU"], $data["name"], $data["price"], $data["weight"]);
        } else if($data["productType"] == "Furniture"){
            $product = new Furniture($data["SKU"], $data["name"], $data["price"], $data["height"], $data["width"], $data["length"]);
        }

//        $product->validate_product_properties();
//        if(!$this->check_unick_sku($data["SKU"])){
//            header("HTTP/1.0 400 Bad Request");
//            echo json_encode(["message" => "400 Bad Request"]);
//            exit;
//        }

        return $product;
    }

//    public function check_unick_sku (string $sku) : bool {
//        $this->data_conn->connect();
//        $book = $this->data_conn->select("book");
//        $dvd = $this->data_conn->select("DVD");
//        $furniture = $this->data_conn->select("furniture");
//        $array = array_merge($book, $dvd, $furniture);
//        foreach ($array as $item){
//            if($item["SKU"] == $sku) return false;
//        }
//        return true;
//    }

}