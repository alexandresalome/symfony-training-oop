<?php

namespace App\Invoice;

class InvoiceLine
{
    private Description $description;
    private Quantity $quantity;
    private Price $unitPrice;

    public function __construct(Description $description, Quantity $quantity, Price $unitPrice)
    {
        $this->description = $description;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
    }
}
