<?php

namespace App\Price;

class Price implements PriceInterface
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

    public function addPrice(PriceInterface $price): PriceInterface
    {
        $this->ensureSameCurrency($price);

        return new Price(
            $this->amount + $price->amount,
            $this->currency
        );
    }

    private function ensureSameCurrency(PriceInterface $price): void
    {
        if ($this->currency->getCurrency() !== $price->getCurrency()->getCurrency()) {
            throw new \InvalidArgumentException(sprintf(
                'Cannot mix currency "%s" with "%s".',
                $this->currency->getCurrency(),
                $price->getCurrency()->getCurrency()
            ));
        }
    }
}
