<?php

namespace App\Invoice;

class InvoiceNumber
{
    private const VALIDATION_RULE = '/^IN-\d+$/';
    private string $number;

    public function __construct(string $number)
    {
        $this->number = $number;
    }

    public function getNumber(): string
    {
        return $this->number;
    }
}
