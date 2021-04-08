<?php

namespace App\Invoice\Validator;

use App\Invoice\Invoice;

class GithubIsUpValidator implements InvoiceValidatorInterface
{
    public function validate(Invoice $invoice): void
    {
        if (!@file_get_contents('https://github.comxxxxx')) {
            throw new \InvalidArgumentException('GITHUB IS DOWN');
        }
    }
}
