<?php

require_once 'src/Basket.php';

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
