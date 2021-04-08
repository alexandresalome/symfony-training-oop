<?php

namespace App\Invoice\Validator\Factory;

use App\Invoice\Invoice;
use App\Invoice\Validator\ChainValidator;
use App\Invoice\Validator\InvoiceValidatorInterface;

class ChainValidatorFactory implements ValidatorFactoryInterface
{
    /**
     * @var ValidatorFactoryInterface[]
     */
    private array $validatorFactory;

    /**
     * @param ValidatorFactoryInterface[] $validatorFactory
     */
    public function __construct(array $validatorFactory)
    {
        $this->validatorFactory = $validatorFactory;
    }

    public function createValidator(Invoice $invoice): InvoiceValidatorInterface
    {
        $validators = array_map(function (ValidatorFactoryInterface $factory) use ($invoice) {
            return $factory->createValidator($invoice);
        }, array_filter($this->validatorFactory, function (ValidatorFactoryInterface $factory) use ($invoice) {
            return $factory->support($invoice);
        }));

        return new ChainValidator($validators);
    }

    public function support(Invoice $invoice): bool
    {
        foreach ($this->validatorFactory as $factory) {
            if ($factory->support($invoice)) {
                return true;
            }
        }

        return false;
    }
}
