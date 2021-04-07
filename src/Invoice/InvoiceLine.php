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

    public function getDescription(): Description
    {
        return $this->description;
    }

    public function getQuantity(): Quantity
    {
        return $this->quantity;
    }

    public function getUnitPrice(): Price
    {
        return $this->unitPrice;
    }

    public function getTotalPrice(): Price
    {
        return new Price($this->unitPrice->getAmount() * $this->quantity->getQuantity(), new Currency('EUR'));
    }
}
