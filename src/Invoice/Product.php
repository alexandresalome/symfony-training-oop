<?php

namespace App\Invoice;

use App\Price\PriceInterface;

class Product
{
    private string $name;
    private PriceInterface $price;

    public function __construct(string $name, PriceInterface $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
}
