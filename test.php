<?php

namespace Main;

use App\Invoice\Builder\InvoiceBuilder;
use App\Invoice\InvoiceRenderer;
use App\Invoice\Validator\ChainValidator;
use App\Invoice\Validator\GithubIsUpValidator;
use App\Invoice\Validator\NoDifferentPriceValidator;
use App\Price\Price;
use App\Price\Currency;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\Console\Style\StyleInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

require_once __DIR__.'/vendor/autoload.php';

$validator = new ChainValidator([
    new GithubIsUpValidator(),
    new NoDifferentPriceValidator(),
]);

$builder = new InvoiceBuilder($validator);

$builder
    // Due date
    // Lines
    ->beginLine()
        ->setDescription('Fluo pencil')
        ->setUnitPrice(new Price(100, new Currency('USD')))
    ->endLine()
    ->beginLine()
        ->setDescription('Fluo pencil')
    ->endLine()

    ->beginLine()
        ->setDescription('Black pencil')
        ->setUnitPrice(new Price(50, new Currency('USD')))
    ->endLine()

    ->getLine(0)
        ->setDescription('HAOU')
        ->setQuantity(4000)
;

$input = new ArgvInput();
$output = new StreamOutput(STDOUT);
/** @var StyleInterface $style */
$style = new SymfonyStyle($input, $output);

try {
    $invoice = $builder->createInvoice();
} catch (\InvalidArgumentException $e) {
    $style->error($e->getMessage());

    exit(1);
}

(new InvoiceRenderer($style))->render($invoice);
