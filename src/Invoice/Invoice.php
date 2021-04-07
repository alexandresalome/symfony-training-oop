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

        /** @var InvoiceLine $line */
        foreach ($this->lineCollection as $line) {
            $total = $total->addPrice($line->getTotalPrice());
        }

        return $total;
    }
}
