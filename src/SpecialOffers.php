<?php

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
