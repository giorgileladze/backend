<?php

namespace api\products\model;
abstract class Product
{

    const TABLE_NAME = "";

    protected String $SKU;
    protected String $name;
    protected float $price;

    public function __construct( string $SKU, string $name, float $price)
    {
        $this->SKU = $SKU;
        $this->name = $name;
        $this->price = $price;
    }

    abstract public function get_properties () : array;

    abstract public function validate_product_properties () : bool;

    public function validate_basic_properties (string $sku, string $name, float $price) : bool {
        $bool = true;

        if(empty($sku)) $bool = false;
        if(empty($name)) $bool = false;
        if(empty($price) || $price <= 0) $bool = false;

       return $bool;
    }
}