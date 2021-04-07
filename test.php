<?php

namespace Main;

use App\Invoice\Builder\InvoiceBuilder;
use App\Invoice\Currency;
use App\Invoice\Description;
use App\Invoice\Price;

require_once __DIR__.'/vendor/autoload.php';

$builder = new InvoiceBuilder();

$builder
    // Due date
    // Lines
    ->beginLine()
        ->setDescription(new Description('Fluo pencil'))
        ->setUnitPrice(new Price(100, new Currency('EUR')))
    ->endLine()

    ->beginLine()
        ->setDescription(new Description('Black pencil'))
        ->setUnitPrice(new Price(50, new Currency('EUR')))
    ->endLine()
;

$invoice = $builder->createInvoice();

dd($invoice);
