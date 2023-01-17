<?php

namespace api\controllers;

use api\DB_Connection\DataBaseConn;
use api\products\model\Product;
use api\products\productFactory\ProductFactory;

class AddProductController {
    private ?ProductFactory $product_factory = null;
    public function __construct(private array $data)
    {
        $this->product_factory = ProductFactory::get_product_factory_object();
        $this->data_conn = new DataBaseConn();
    }

    public function save_data () : array {
            $this->data_conn->connect();

            if(!$this->check_unick_sku($this->data["SKU"])){
                header("HTTP/1.0 400 Bad Request");
                echo json_encode(["message" => "400 Data is invalid"]);
                exit;
            }

            $product = $this->create_product_object();
            $this->data_conn->insert($product);

            return [
                "message" => "data is saved",
                "data" => $this->data,
            ];
    }

    private function create_product_object () : Product {
        $product = $this->product_factory->create_product($this->data);
        return $product;
    }

    public function check_unick_sku (string $sku) : bool {
        $this->data_conn->connect();
        return $this->data_conn->check_sku($sku);
    }

}