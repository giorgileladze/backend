<?php

namespace api\src\products\productTypes;

use api\src\products\model\Product;

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
        $bool = true;
        if(!$this->validate_basic_properties($this->SKU, $this->name, $this->price)) $bool = false;

        if(empty($this->weight)) $bool = false;

        return $bool;
    }
}