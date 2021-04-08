<?php

namespace App\Invoice\Builder;

use App\Invoice\Invoice;
use App\Invoice\InvoiceLineCollection;
use App\Invoice\InvoiceNumber;

class InvoiceBuilder
{
    private array $lineBuilders = [];

    public function beginLine(): InvoiceLineBuilder
    {
        $builder = new InvoiceLineBuilder($this, count($this->lineBuilders));
        $this->lineBuilders[] = $builder;

        return $builder;
    }

    public function createInvoice(string $number): Invoice
    {
        $invoiceNumber = new InvoiceNumber($number);

        $map = function (InvoiceLineBuilder $builder) {
            return $builder->createLine();
        };

        $lines = array_map($map, $this->lineBuilders);

        $lineCollection = new InvoiceLineCollection($lines);

        return new Invoice($invoiceNumber, $lineCollection);
    }

    public function getLine(int $position): InvoiceLineBuilder
    {
        if (!isset($this->lineBuilders[$position])) {
            throw new \InvalidArgumentException(
                sprintf(
                    'No line at position %d. Positions are: %s',
                    $position,
                    empty($this->lineBuilders) ? '*none*' : implode(', ', array_keys($this->lineBuilders))
                )
            );
        }

        return $this->lineBuilders[$position];
    }
}
