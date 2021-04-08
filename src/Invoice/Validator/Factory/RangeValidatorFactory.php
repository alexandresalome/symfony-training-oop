<?php

namespace App\Invoice\Validator\Factory;

use App\Invoice\Invoice;
use App\Invoice\Validator\ChainValidator;
use App\Invoice\Validator\GithubIsUpValidator;
use App\Invoice\Validator\HasLineValidator;
use App\Invoice\Validator\InvoiceValidatorInterface;

class RangeValidatorFactory implements ValidatorFactoryInterface
{
    public function createValidator(Invoice $invoice): InvoiceValidatorInterface
    {
        return new ChainValidator([
            new GithubIsUpValidator(),
            new HasLineValidator(),
        ]);
    }

    public function support(Invoice $invoice): bool
    {
        return $invoice->getPrice()->getAmount() > 100_000;
    }
}
