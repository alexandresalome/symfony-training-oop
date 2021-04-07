<?php

namespace App\Invoice;

interface PriceInterface
{
    public function getAmount(): int;
    public function getCurrency(): Currency;
    public function toString(): string;
}
