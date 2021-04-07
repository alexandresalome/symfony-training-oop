<?php

namespace App\Invoice;

use Exception;
use Traversable;

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
}
