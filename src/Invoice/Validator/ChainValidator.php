<?php

namespace App\Invoice\Validator;

use App\Invoice\Invoice;

class ChainValidator implements InvoiceValidatorInterface
{
    /**
     * @var InvoiceValidatorInterface[]
     */
    private $validators;

    /**
     * @param InvoiceValidatorInterface[] $validators
     */
    public function __construct(array $validators)
    {
        $this->validators = $validators;
    }

    public function validate(Invoice $invoice): void
    {
        /** @var string[] $errors */
        $errors = [];
        foreach ($this->validators as $validator) {
            try {
                $validator->validate($invoice);
            } catch (\InvalidArgumentException $e) {
                $errors[] = $e;
            }
        }

        if (empty($errors)) {
            return;
        }

        if (1 === count($errors)) {
            throw $errors[0];
        }

        throw new \InvalidArgumentException(sprintf(
            "Errors occurred while validating the order:\n- %s",
            implode("\n- ", array_map(function (\InvalidArgumentException $e) {
                return $e->getMessage();
            }, $errors))
        ));
    }
}
