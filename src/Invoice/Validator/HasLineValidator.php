<?php

namespace App\Invoice\Validator;

use App\Invoice\Invoice;

class HasLineValidator implements InvoiceValidatorInterface
{
    public function validate(Invoice $invoice): void
    {
    }
}
