<?php

namespace App\Invoice;

class InvoiceLine
{
    private Description $description;
    private Quantity $quantity;
    private PriceInterface $unitPrice;

    public function __construct(Description $description, Quantity $quantity, PriceInterface $unitPrice)
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

    public function getUnitPrice(): PriceInterface
    {
        return $this->unitPrice;
    }

    public function getTotalPrice(): PriceInterface
    {
        return new Price($this->unitPrice->getAmount() * $this->quantity->getQuantity(), new Currency('EUR'));
    }
}
