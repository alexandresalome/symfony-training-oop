<?php

namespace App\Invoice;

class Quantity
{
    private int $quantity;

    public function __construct(int $quantity)
    {
        if ($quantity < 1) {
            throw new \InvalidArgumentException(sprintf(
                'Expected quantity to be greater or equal to 1, got %d.',
                $quantity
            ));
        }
        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
