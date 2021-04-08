<?php


namespace App\ValueComputer;

use App\Price\Priced;

interface Valuable extends Priced
{
    public function getCount(): int;
}
