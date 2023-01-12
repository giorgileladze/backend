<?php

namespace api\src\products\productTypes;

use api\src\products\model\Product;

class DVD extends Product {

    private int $size;

    public const TABLE_NAME = "DVD";

    public function __construct(string $SKU, string $name, float $price, int $size)
    {
        parent::__construct($SKU, $name, $price);

        $this->size = $size;
    }

    public function get_properties(): array
    {
        return [
            "sku" => $this->SKU,
            "name" => $this->name,
            "price" => $this->price,
            "size" => $this->size,
        ];
    }

    public function validate_product_properties () : bool {
        $bool = true;

        if(!$this->validate_basic_properties($this->SKU, $this->name, $this->price)) $bool = false;

        if(empty($this->size)) $bool = false;

        return $bool;
    }
}