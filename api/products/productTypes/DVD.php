<?php

namespace api\products\productTypes;

use api\products\model\Product;

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
        $bool = parent::validate_product_properties();

        if(empty($this->size) || !preg_match("/^[0-9]*$/", $this->size)) $bool = false;

        return $bool;
    }
}