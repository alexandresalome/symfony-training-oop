<?php

namespace App\Invoice\Validator;

use App\Invoice\Invoice;

interface InvoiceValidatorInterface
{
    /**
     * @throws \InvalidArgumentException Invoice is not valid
     */
    public function validate(Invoice $invoice): void;
}
