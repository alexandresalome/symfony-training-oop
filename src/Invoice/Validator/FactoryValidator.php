<?php

namespace App\Invoice\Validator;

use App\Invoice\Invoice;
use App\Invoice\Validator\Factory\ValidatorFactoryInterface;

class FactoryValidator implements InvoiceValidatorInterface
{
    /**
     * @var ValidatorFactoryInterface
     */
    private ValidatorFactoryInterface $factory;

    public function __construct(ValidatorFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function validate(Invoice $invoice): void
    {
        $validator = $this->factory->createValidator($invoice);
        $validator->validate($invoice);
    }
}
