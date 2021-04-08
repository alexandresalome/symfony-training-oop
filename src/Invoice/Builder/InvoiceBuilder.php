<?php

namespace App\Invoice\Builder;

use App\Invoice\Invoice;
use App\Invoice\InvoiceLineCollection;
use App\Invoice\Validator\InvoiceValidatorInterface;

class InvoiceBuilder
{
    private array $lineBuilders = [];

    private InvoiceValidatorInterface $validator;

    public function __construct(InvoiceValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function beginLine(): InvoiceLineBuilder
    {
        $builder = new InvoiceLineBuilder($this, count($this->lineBuilders));
        $this->lineBuilders[] = $builder;

        return $builder;
    }

    public function createInvoice(): Invoice
    {
        $map = function (InvoiceLineBuilder $builder) {
            return $builder->createLine();
        };

        $lines = array_map($map, $this->lineBuilders);

        $lineCollection = new InvoiceLineCollection($lines);

        $invoice = new Invoice($lineCollection);
        $this->validator->validate($invoice);

        return $invoice;
    }

    public function getLine(int $position): InvoiceLineBuilder
    {
        if (!isset($this->lineBuilders[$position])) {
            throw new \InvalidArgumentException(sprintf(
                'No line at position %d. Positions are: %s',
                $position,
                empty($this->lineBuilders) ? '*none*' : implode(', ', array_keys($this->lineBuilders))
            ));
        }

        return $this->lineBuilders[$position];
    }
}
