<?php

namespace App\Invoice;

class Quantity
{
    private int $quantity;

    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }
}
