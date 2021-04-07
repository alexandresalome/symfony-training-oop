<?php

namespace App\Invoice;

class Price
{
    private int $amount;
    private Currency $currency;

    /**
     * @param int $amount Value in cents
     */
    public function __construct(int $amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function toString(): string
    {
        return round($this->amount / 100, 2). ' '.$this->currency->getCurrency();
    }

    public function getAmount(): int
    {
        return  $this->amount;
    }
}
