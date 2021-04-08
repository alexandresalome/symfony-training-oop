<?php

namespace App\Price;

interface PriceInterface
{
    public function getAmount(): int;
    public function getCurrency(): Currency;
    public function toString(): string;
}
