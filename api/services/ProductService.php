<?php

namespace api\services;

use api\DB_Connection\ProductDataBaseConnection;
use api\products\model\Product;
use api\products\productFactory\ProductFactory;

class ProductService
{

    public function __construct () {
        $this->products_db = new ProductDataBaseConnection();
    }

    public function check_unic_sku (string $sku) : bool {
        $bool = true;
        $data = $this->products_db->get_all_skus();

        foreach ($data as $obj){
            if($obj["SKU"] == $sku) $bool = false;
        }
        return $bool;
    }

    public function create_product_object (array $data) : Product {
        $product_factory = ProductFactory::get_product_factory_object();
        return $product_factory->create_product($data);
    }

    public function insert_into_database(Product $product) {
        $this->products_db->insert($product);
    }

    public function validate_data (Product $product) : bool{
        $bool = true;
        if(!$this->check_unic_sku($product->get_sku())){
            $bool = false;
        }
        if(!$product->validate_product_properties()){
            $bool = false;
        }
        return $bool;
    }

    public function get_all_product () : array {
        $dvd = $this->get_product_from_db("DVD");
        $book = $this->get_product_from_db("book");
        $furniture = $this->get_product_from_db("furniture");

        return [
            ["book", $book],
            ["dvd", $dvd],
            ["furniture", $furniture]
        ];
    }

    public function delete_by_sku(array $skus) {
        $this->products_db->delete_product($skus);
    }

    private function get_product_from_db (string $type) : array {
        return $this->products_db->select($type);
    }

    public function fill_product_type (array $data) : array {
        $filledData = [];
        foreach ($data as $productCollection){
            foreach ($productCollection["1"] as $product) {
                $product["type"] = $productCollection["0"];
                $filledData[] = $product;
            }
        }
        return $filledData;
    }
}