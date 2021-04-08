<?php

namespace App\Invoice;

use App\Price\Currency;
use App\Price\Priced;
use App\Price\PriceInterface;

class Invoice implements Priced
{

    private InvoiceNumber $number;
    private InvoiceLineCollection $lineCollection;
    private Currency $currency;

    public function __construct(InvoiceNumber $number, InvoiceLineCollection $lineCollection, ?Currency $currency = null)
    {
        $this->number = $number;
        $this->lineCollection = $lineCollection;
        $this->currency = $currency ?? new Currency('EUR');
    }

    public function getNumber(): InvoiceNumber
    {
        return $this->number;
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
