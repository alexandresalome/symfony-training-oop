<?php

namespace App\Invoice;

class Invoice
{
    private InvoiceLineCollection $lineCollection;

    public function __construct(InvoiceLineCollection $lineCollection)
    {
        $this->lineCollection = $lineCollection;
    }

    /**
     * @return InvoiceLineCollection|InvoiceLine[]
     */
    public function getLines(): iterable
    {
        return $this->lineCollection;
    }

    public function getTotal(): Price
    {
        $total = new Price(0, new Currency('EUR'));

        $total->addPrice($this->lineCollection->getTotal());

        return $total;
    }
}
