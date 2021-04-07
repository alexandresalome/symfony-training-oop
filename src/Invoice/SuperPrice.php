<?php

namespace App\Invoice;

class SuperPrice implements PriceInterface
{
    public function getAmount(): int
    {
        return 1_000_000;
    }

    public function getCurrency(): Currency
    {
        return new Currency('EUR');
    }

    public function toString(): string
    {
        return 'SUPER';
    }
}
