<?php

namespace App\ValueComputer;

use App\Price\Currency;
use App\Price\Price;
use App\Price\PriceInterface;

class Inventory
{
    /** @var Valuable[] */
    private array $valuables;

    public function __construct(array $valuables)
    {
        foreach ($valuables as $key => $value) {
            if (!$value instanceof Valuable) {
                throw new \InvalidArgumentException(sprintf(
                    'Object as position %d is expected to be a Valuable, got a "%s".',
                    $key,
                    is_object($value) ? get_class($value) : strtolower(gettype($value))
                ));
            }
        }
        $this->valuables = $valuables;
    }

    public function getPrice(): PriceInterface
    {
        $value = new Price(0, new Currency('EUR'));
        foreach ($this->valuables as $valuable) {
            $value = $value->addPrice($valuable->getPrice());
        }

        return $value;
    }
}
