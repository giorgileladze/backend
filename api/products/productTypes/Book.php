<?php

namespace api\products\productTypes;

use api\products\model\Product;

class Book extends Product {

    public const TABLE_NAME = "book";

    private float $weight;
    public function __construct(string $SKU, string $name, float $price, float $weight)
    {
        parent::__construct($SKU, $name, $price);
        $this->weight = $weight;
    }

    public function get_properties(): array
    {
        return [
            "sku" => $this->SKU,
            "name" => $this->name,
            "price" => $this->price,
            "weight" => $this->weight,
        ];
    }

    public function validate_product_properties () : bool {
        $bool = parent::validate_product_properties();

        if(empty($this->weight) || !preg_match("/^[0-9]*$/", $this->weight)) $bool = false;

        return $bool;
    }
}