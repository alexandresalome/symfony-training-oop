<?php

namespace App\Invoice;

use App\Price\Currency;
use App\Price\Price;
use App\Price\Priced;
use App\Price\PriceInterface;

class InvoiceLineCollection implements \IteratorAggregate, \Countable, Priced
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

    public function getPrice(): PriceInterface
    {
        $total = new Price(0, new Currency('USD'));

        /** @var InvoiceLine $line */
        foreach ($this as $line) {
            $total = $total->addPrice($line->getPrice());
        }

        return $total;
    }
}
