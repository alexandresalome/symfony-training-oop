<?php

namespace App\Invoice\Validator;

use App\Invoice\Invoice;

class NoDifferentPriceValidator implements InvoiceValidatorInterface
{
    public function validate(Invoice $invoice): void
    {
        throw new \InvalidArgumentException('OMG DIFFERENT PRICES!!!');
    }
}
