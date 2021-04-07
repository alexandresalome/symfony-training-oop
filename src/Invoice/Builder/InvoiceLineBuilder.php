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

    public function __construct(InvoiceBuilder $invoiceBuilder)
    {
        $this->invoiceBuilder = $invoiceBuilder;
        $this->quantity = new Quantity(1);
    }

    public function setDescription(Description $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function setUnitPrice(Price $price): self
    {
        $this->unitPrice = $price;

        return $this;
    }

    public function setQuantity(Quantity $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function endLine(): InvoiceBuilder
    {
        return $this->invoiceBuilder;
    }

    public function createLine(): InvoiceLine
    {
        return new InvoiceLine(
            $this->description,
            $this->quantity,
            $this->unitPrice,
        );
    }
}
