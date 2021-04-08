<?php

namespace App\Invoice\Validator\Factory;

use App\Invoice\Invoice;
use App\Invoice\Validator\BillingNumberValidator;
use App\Invoice\Validator\ChainValidator;
use App\Invoice\Validator\InvoiceValidatorInterface;

class DateValidatorFactory implements ValidatorFactoryInterface
{
    public function createValidator(Invoice $invoice): InvoiceValidatorInterface
    {
        return new ChainValidator([
            new BillingNumberValidator(),
        ]);
    }

    public function support(Invoice $invoice): bool
    {
        return date('Ymd') === '20210408';
    }
}
