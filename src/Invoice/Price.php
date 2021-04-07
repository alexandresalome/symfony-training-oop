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

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function addPrice(Price $price): Price
    {
        if ($this->currency->getCurrency() !== $price->getCurrency()->getCurrency()) {
            throw new \InvalidArgumentException();
        }

        return $this->add($price->getAmount());
    }

    public function add(int $amount): Price
    {
        return new Price($this->amount + $amount, $this->getCurrency());
    }
}
