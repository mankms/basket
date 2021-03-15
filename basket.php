<?php

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

class SpecialOffers
{
    protected $catalogue;
    protected $products;

    public function __construct($catalogue, $products)
    {
        $this->catalogue = $catalogue;
        $this->products = $products;
    }

    public function getDiscount()
    {
        $discount = 0;

        $discount += $this->getSecondRedDiscount();

        return $discount;
    }

    public function getSecondRedDiscount()
    {
        $redWidgetCode = 'R01';
        if ($this->getProductQty($redWidgetCode) > 1) {
            $redWidget = $this->catalogue->find($redWidgetCode);

            return round($redWidget['price'] / 2, 2);
        }

        return 0;
    }

    protected function getProductQty($code)
    {
        $qty = 0;
        foreach ($this->products as $productCode) {
            if ($productCode === $code) {
                $qty++;
            }
        }

        return $qty;
    }
}

class DeliveryCalculator
{
    public static function calc($total)
    {
        if ($total >= 90) {
            return 0;
        }

        if ($total >= 50) {
            return 2.95;
        }

        return 4.95;
    }
}

$products = [
    ['product' => 'Red Widget', 'code' => 'R01', 'price' => 32.95],
    ['product' => 'Green Widget', 'code' => 'G01', 'price' => 24.95],
    ['product' => 'Blue Widget', 'code' => 'B01', 'price' => 7.95],
];

echo (new Basket(new Catalogue($products)))
    // ->addProducts(['B01', 'G01'])
    // ->addProducts(['R01', 'R01'])
    // ->addProducts(['R01', 'G01'])
    ->addProducts(['B01', 'B01', 'R01', 'R01', 'R01'])
    ->total();
