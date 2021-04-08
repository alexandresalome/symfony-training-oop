<?php

namespace App\Invoice;

use App\Price\PriceInterface;

class Payment
{
    private PriceInterface $amount;

    public function __construct(PriceInterface $amount)
    {
        $this->amount = $amount;
    }
}
