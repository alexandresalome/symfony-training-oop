<?php

namespace App\Invoice\Builder;

use App\Invoice\Description;
use App\Invoice\InvoiceLine;
use App\Invoice\Price;
use App\Invoice\Quantity;

class InvoiceLineBuilder
{
    private ?Description $description = null;
    private ?Price $unitPrice = null;
    private ?Quantity $quantity = null;
    private InvoiceBuilder $invoiceBuilder;
    private int $position;

    public function __construct(InvoiceBuilder $invoiceBuilder, int $position)
    {
        $this->invoiceBuilder = $invoiceBuilder;
        $this->position = $position;
        $this->quantity = new Quantity(1);
    }

    /**
     * @param string|Description $description
     */
    public function setDescription($description): self
    {
        if (is_string($description)) {
            $description = new Description($description);
        }
        $this->description = $description;

        return $this;
    }

    public function setUnitPrice(Price $price): self
    {
        $this->unitPrice = $price;

        return $this;
    }

    /**
     * @param int|Quantity $quantity
     * @return $this
     */
    public function setQuantity($quantity): self
    {
        $this->quantity = $quantity instanceof Quantity ? $quantity : new Quantity($quantity);

        return $this;
    }

    public function endLine(): InvoiceBuilder
    {
        return $this->invoiceBuilder;
    }

    public function createLine(): InvoiceLine
    {
        if (null === $this->description) {
            throw new \InvalidArgumentException(sprintf('Cannot create line n°%d: no description.', $this->position));
        }

        if (null === $this->unitPrice) {
            throw new \InvalidArgumentException(sprintf('Cannot create line n°%d: no unit price.', $this->position));
        }

        return new InvoiceLine(
            $this->description,
            $this->quantity,
            $this->unitPrice,
        );
    }
}
