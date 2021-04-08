<?php

namespace App\Invoice\Validator\Factory;

use App\Invoice\Invoice;
use App\Invoice\Validator\InvoiceValidatorInterface;

interface ValidatorFactoryInterface
{
    public function createValidator(Invoice $invoice): InvoiceValidatorInterface;
    public function support(Invoice $invoice): bool;
}
