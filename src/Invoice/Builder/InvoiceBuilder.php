<?php

namespace App\Invoice\Builder;

use App\Invoice\Invoice;
use App\Invoice\InvoiceLineCollection;

class InvoiceBuilder
{
    private array $lineBuilders = [];

    public function beginLine(): InvoiceLineBuilder
    {
        $builder = new InvoiceLineBuilder($this);
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

        return new Invoice($lineCollection);
    }
}
