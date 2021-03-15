<?php

class Basket
{
    protected $catalogue;
    protected $deliveryCalculator;
    protected $specialOffers;
    protected $products;

    public function __construct($catalogue, $specialOffers, $deliveryCalculator)
    {
        $this->catalogue = $catalogue;
        $this->specialOffers = $specialOffers;
        $this->deliveryCalculator = $deliveryCalculator;
    }

    public function addProducts($products)
    {
        $this->products = $products;
    }

    public function total()
    {
        return 11.22;
    }
}

$products = [
    ['product' => 'Red Widget', 'code' => 'R01', 'price' => 32.95],
    ['product' => 'Green Widget', 'code' => 'G01', 'price' => 24.95],
    ['product' => 'Blue Widget', 'code' => 'B01', 'price' => 7.95],
];
// [49.99 => 4.95, 89.99 => 2.95, 90 => 0]
echo (new Basket(new Catalogue($products), new SpecialOffers(), new DeliveryCalculator()))
    ->addProducts(['B01', 'G01'])
    ->total();
