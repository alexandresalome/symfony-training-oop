<?php

namespace App\Invoice\Validator;

use App\Invoice\Invoice;

class BillingNumberValidator implements InvoiceValidatorInterface
{
    private const REGEX = '/^IN-%s-\d+$/';

    public function validate(Invoice $invoice): void
    {
        $number = $invoice->getNumber()->getNumber();
        $date = date('Ymd');
        $regex = sprintf(self::REGEX, $date);

        if (preg_match($regex, $number)) {
            return;
        }

        throw new \InvalidArgumentException(sprintf(
            'Invoice number is "%s". Expected to be "IN-%s-XXX" (X = number).',
            $number,
            $date
        ));
    }
}
