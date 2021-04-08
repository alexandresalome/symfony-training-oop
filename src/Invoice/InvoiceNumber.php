<?php

namespace App\Invoice;

class InvoiceNumber
{
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
