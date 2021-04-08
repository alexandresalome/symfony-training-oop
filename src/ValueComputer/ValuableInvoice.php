<?php

namespace App\ValueComputer;

use App\Invoice\Invoice;
use App\Price\PriceInterface;

class ValuableInvoice implements Valuable
{
    private Invoice $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function getPrice(): PriceInterface
    {
        return $this->invoice->getPrice();
    }

    public function getCount(): int
    {
        return 1;
    }
}
