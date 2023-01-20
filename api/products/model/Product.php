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

    public function validate_product_properties () : bool {
        $bool = true;

        if(empty($this->SKU) || !preg_match("/^[a-zA-Z]*$/", $this->SKU)) $bool = false;
        if(empty($this->name) || !preg_match("/^[a-zA-Z]*$/", $this->name)) $bool = false;
        if(empty($this->price) || $this->price <= 0 || !preg_match("/^[0-9]*$/", $this->price)) $bool = false;

       return $bool;
    }

    public function get_sku()
    {
        return $this->SKU;
    }
}