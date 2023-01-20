<?php


namespace api\products\productTypes;

use api\products\model\Product;

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
        $bool = parent::validate_product_properties();

        if(empty($this->width) || !preg_match("/^[0-9]*$/", $this->width)) $bool = false;
        if(empty($this->height) || !preg_match("/^[0-9]*$/", $this->height)) $bool = false;
        if(empty($this->length) || !preg_match("/^[0-9]*$/", $this->length)) $bool = false;

        return $bool;
    }
}