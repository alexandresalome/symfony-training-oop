<?php

namespace App\Price;

class Currency
{
    private const ALLOWED_CURRENCIES = ['EUR', 'USD'];

    private string $currency;

    public function __construct(string $currency)
    {
        if (!in_array($currency, self::ALLOWED_CURRENCIES, true)) {
            throw new \InvalidArgumentException(sprintf(
                'Currency is "%s", expected one of %s.',
                $currency,
                implode(', ', self::ALLOWED_CURRENCIES)
            ));
        }
        $this->currency = $currency;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}
