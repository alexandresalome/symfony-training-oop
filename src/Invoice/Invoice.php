<?php

namespace App\Invoice;

use App\Price\Currency;
use App\Price\Priced;
use App\Price\PriceInterface;

class Invoice implements Priced
{
    private Currency $currency;
    private InvoiceLineCollection $lineCollection;

    public function __construct(InvoiceLineCollection $lineCollection, ?Currency $currency = null)
    {
        $this->currency = $currency ?? new Currency('EUR');
        $this->lineCollection = $lineCollection;
    }

    /**
     * @return InvoiceLineCollection|InvoiceLine[]
     */
    public function getLines(): iterable
    {
        return $this->lineCollection;
    }

    public function getPrice(): PriceInterface
    {
        return $this->lineCollection->getPrice();
    }

    public function getCount(): int
    {
        return 1;
    }
}
