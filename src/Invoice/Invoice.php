<?php

namespace App\Invoice;

class Invoice
{
    private InvoiceLineCollection $lineCollection;

    public function __construct(InvoiceLineCollection $lineCollection)
    {
        $this->lineCollection = $lineCollection;
    }
}
