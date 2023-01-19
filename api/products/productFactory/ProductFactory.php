<?php

namespace api\products\productFactory;

use api\products\model\Product;
use api\products\productTypes\Book;
use api\products\productTypes\DVD;
use api\products\productTypes\Furniture;

class ProductFactory {
    private static ?ProductFactory $product_factory_object = null;

    private array $products = [
        "DVD" => "create_dvd",
        "Book" => "create_book",
        "Furniture" => "create_furniture",
    ];

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

        $type = $data["productType"];

        $function = $this->products[$type];

        $product = $this->$function($data);

        return $product;
    }

    private function create_furniture (array $data) : Furniture {
        return new Furniture($data["SKU"], $data["name"], $data["price"], $data["height"], $data["width"], $data["length"]);
    }
    private function create_book (array $data ) : Book {
        return new Book($data["SKU"], $data["name"], $data["price"], $data["weight"]);
    }
    private function create_dvd (array $data) : DVD {
        return new DVD($data["SKU"], $data["name"], $data["price"], $data["size"]);
    }

}