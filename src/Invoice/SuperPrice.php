<?php

namespace App\Invoice;

use App\Price\PriceInterface;
use App\Price\Currency;

class SuperPrice implements PriceInterface
{
    public function getAmount(): int
    {
        return 1_000_000;
    }

    public function getCurrency(): Currency
    {
        return new Currency('USD');
    }

    public function toString(): string
    {
        return 'SUPER';
    }
}
