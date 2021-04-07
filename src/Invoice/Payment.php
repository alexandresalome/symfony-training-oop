<?php

namespace App\Invoice;

class Payment
{
    private Price $amount;

    public function __construct(Price $amount)
    {
        $this->amount = $amount;
    }
}
