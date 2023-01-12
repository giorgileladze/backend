<?php

namespace api\controllers;
use api\DB_Connection\DataBaseConn;

class DeleteProductController {

    public function __construct(private array $products_sku)
    {
        $this->data_conn = new DataBaseConn();
    }

    public function delete_products () : array {
        $this->data_conn->connect();
        $num = $this->data_conn->delete_by_sku($this->products_sku);

        $response = [
            "message" => "$num rows deleted"
        ];

        $this->data_conn->close_conn();
         return $response;
    }

}