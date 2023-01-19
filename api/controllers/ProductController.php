<?php

namespace api\controllers;

use api\services\ProductService;

class ProductController
{
    private array $request;

    private ProductService $product_service;

    public function __construct (array $request) {
        $this->request = $request;
        $this->product_service = new ProductService();
    }
    public function get_data () : array {
        $data = $this->product_service->get_all_product();
        $data = $this->product_service->fill_product_type($data);
        return $data;
    }

    public function save_data () {
        $product = $this->product_service->create_product_object($this->request["data"]["formData"]);

        if(!$this->product_service->validate_data($product)) {
            http_response_code(500);
            return;
        }

        $this->product_service->insert_into_database($product);
    }

    public function delete_data () {
        $skus = $this->request["data"];
        $this->product_service->delete_by_sku($skus);
    }
}