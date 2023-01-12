<?php


namespace api\src\products\productTypes;

use api\src\products\model\Product;

class Furniture extends Product
{
    public const TABLE_NAME = "furniture";
    private float $height;
    private float $width;
    private float $length;
    public function __construct(string $SKU, string $name, float $price, float $height, float $width, float $length)
    {
        parent::__construct($SKU, $name, $price);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function get_properties(): array
    {
        return [
            "sku" => $this->SKU,
            "name" => $this->name,
            "price" => $this->price,
            "height" => $this->height,
            "width" => $this->width,
            "length" => $this->length,
        ];
    }

    public function validate_product_properties () : bool{
        $bool = true;

        if(!$this->validate_basic_properties($this->SKU, $this->name, $this->price)) $bool = false;

        if(empty($this->width) || empty($this->height) || empty($this->length)) $bool = false;

        return $bool;
    }
}