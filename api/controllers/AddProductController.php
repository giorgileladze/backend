<?php

namespace api\controllers;

use api\DB_Connection\DataBaseConn;
use api\src\products\productFactory\ProductFactory;

class AddProductController {
    private ?ProductFactory $product_factory = null;
    public function __construct(private array $data)
    {
        $this->product_factory = ProductFactory::get_product_factory_object();
        $this->data_conn = new DataBaseConn();
    }

    public function save_data () : array{
            $this->data_conn->connect();
            $product = $this->create_product_object();
            $this->data_conn->insert($product);

            return [
                "message" => "data is saved",
                "data" => $this->data,
            ];
    }

    private function create_product_object () {
        $product = $this->product_factory->create_product($this->data);
        return $product;
    }

}