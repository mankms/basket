<?php

require_once 'Catalogue.php';
require_once 'SpecialOffers.php';
require_once 'DeliveryCalculator.php';

class Basket
{
    protected $catalogue;
    protected $products;

    public function __construct($catalogue)
    {
        $this->catalogue = $catalogue;

        return $this;
    }

    public function addProducts($products)
    {
        $this->products = $products;

        return $this;
    }

    public function total()
    {
        $total = 0;

        foreach ($this->products as $code) {
            $product = $this->catalogue->find($code);
            $total += $product['price'];
        }

        $total -= (new SpecialOffers($this->catalogue, $this->products))->getDiscount();
        $total += DeliveryCalculator::calc($total);

        return $total;
    }
}
