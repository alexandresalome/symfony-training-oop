<?php

namespace App\Invoice;

class Invoice
{
    private InvoiceLineCollection $lineCollection;

    public function __construct(InvoiceLineCollection $lineCollection)
    {
        $this->lineCollection = $lineCollection;
    }

    /**
     * @return InvoiceLineCollection|InvoiceLine[]
     */
    public function getLines(): iterable
    {
        return $this->lineCollection;
    }

    public function TotalPrice(): Price
    {
        $total=  array_sum(
            array_map(static function (InvoiceLine $line) {
                return $line->getPriceTotal()->getAmount();
            }, $this->lines)
        );

        return new Price($total, new Currency('EUR'));
    }
}
