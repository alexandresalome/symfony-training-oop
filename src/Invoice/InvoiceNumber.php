<?php

namespace App\Invoice;

use Psr\Log\InvalidArgumentException;

class InvoiceNumber
{
    private const VALIDATION_RULE = '/^INV-\d{3}/';
    private string $number;

    public function __construct(string $number)
    {
        if (!preg_match(self::VALIDATION_RULE, $number)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid invoice number "%s": must match "%s" pattern',
                    $number,
                    self::VALIDATION_RULE
                )
            );
        }
        $this->number = $number;
    }

    public function getNumber(): string
    {
        return $this->number;
    }
}
