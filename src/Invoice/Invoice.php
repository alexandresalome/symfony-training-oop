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
}
