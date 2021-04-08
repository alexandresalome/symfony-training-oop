<?php

namespace App\Invoice;

use App\Price\Price;
use App\Price\Priced;
use App\Price\PriceInterface;

class InvoiceLine implements Priced
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

    public function getPrice(): PriceInterface
    {
        $currency = $this->unitPrice->getCurrency();

        return new Price($this->unitPrice->getAmount() * $this->quantity->getQuantity(), $currency);
    }
}
