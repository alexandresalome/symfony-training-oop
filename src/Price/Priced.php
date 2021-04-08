<?php

namespace App\Price;

/**
 * Represents an object with a financial value.
 */
interface Priced
{
    public function getPrice(): PriceInterface;
}
