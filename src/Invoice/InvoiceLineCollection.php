<?php

namespace App\Invoice;

class InvoiceLineCollection implements \IteratorAggregate, \Countable
{
    /**
     * @var InvoiceLine[]
     */
    private array $lines;

    public function __construct(array $lines)
    {
        $this->lines = $lines;
    }

    public function getIterator(): iterable
    {
        return new \ArrayIterator($this->lines);
    }

    public function count(): int
    {
        return count($this->lines);
    }

    public function getTotal(): Price
    {
        $total = new Price(0, new Currency('EUR'));

        /** @var InvoiceLine $line */
        foreach ($this as $line) {
            $total = $total->addPrice($line->getTotalPrice());
        }

        return $total;
    }
}
