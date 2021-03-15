<?php

class Catalogue
{
    protected $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function find($code)
    {
        foreach ($this->products as $product) {
            if ($product['code'] === $code) {
                return $product;
            }
        }

        return null;
    }
}
