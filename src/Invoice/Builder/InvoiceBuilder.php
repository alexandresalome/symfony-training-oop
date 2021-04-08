<?php

namespace App\Invoice\Builder;

use App\Invoice\Invoice;
use App\Invoice\InvoiceLineCollection;
use App\Invoice\InvoiceNumber;
use App\Invoice\Validator\Factory\ValidatorFactoryInterface;
use App\Invoice\Validator\InvoiceValidatorInterface;

class InvoiceBuilder
{
    private array $lineBuilders = [];
    private ?InvoiceNumber $number = null;
    private ValidatorFactoryInterface $factory;

    public function __construct(ValidatorFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param string|InvoiceNumber $number
     */
    public function setNumber($number): self
    {
        $number = $number instanceof InvoiceNumber ? $number : new InvoiceNumber($number);
        $this->number = $number;

        return $this;
    }

    public function beginLine(): InvoiceLineBuilder
    {
        $builder = new InvoiceLineBuilder($this, count($this->lineBuilders));
        $this->lineBuilders[] = $builder;

        return $builder;
    }

    public function createInvoice(): Invoice
    {
        if (!$this->number) {
            throw new \LogicException('Cannot create invoice: the invoice has no number.');
        }

        $map = function (InvoiceLineBuilder $builder) {
            return $builder->createLine();
        };

        $lines = array_map($map, $this->lineBuilders);

        $lineCollection = new InvoiceLineCollection($lines);
        $invoice = new Invoice($this->number, $lineCollection);

        $validator = $this->factory->createValidator($invoice);
        $validator->validate($invoice);

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
