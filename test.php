<?php

namespace Main;

use App\Invoice\Builder\InvoiceBuilder;
use App\Invoice\Currency;
use App\Invoice\Price;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\Console\Style\SymfonyStyle;

require_once __DIR__.'/vendor/autoload.php';

$builder = new InvoiceBuilder();

$builder
    // Due date
    // Lines
    ->beginLine()
        ->setDescription('Fluo pencil')
        ->setUnitPrice(new Price(100, new Currency('EUR')))
    ->endLine()

    ->beginLine()
        ->setDescription('Black pencil')
        ->setUnitPrice(new Price(50, new Currency('EUR')))
    ->endLine()

    ->getLine(0)
        ->setDescription('HAOU')
;

$invoice = $builder->createInvoice();

$input = new ArgvInput();
$output = new StreamOutput(STDOUT);
$style = new SymfonyStyle($input, $output);

$style->title('LA FACTURE');

$headers = ['Description', 'Qty', 'UP'];
$rows = [];
foreach ($invoice->getLines() as $line) {
    $rows[] = [
        $line->getDescription()->getAbstract(),
        $line->getQuantity()->getQuantity(),
        $line->getUnitPrice()->toString(),
    ];
}

$style->table($headers, $rows);
