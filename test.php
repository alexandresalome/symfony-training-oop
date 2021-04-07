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

$currency = new Currency('EUR');
$builder
    // Due date
    // Lines
    ->beginLine()
    ->setDescription('Fluo pencil')
    ->setUnitPrice(new Price(100, $currency))
    ->endLine()
    ->beginLine()
    ->setDescription('Black pencil')
    ->setUnitPrice(new Price(50, $currency))
    ->endLine()
    ->getLine(0)
    ->setDescription('HAOU');

$invoice = $builder->createInvoice();

$input = new ArgvInput();
$output = new StreamOutput(STDOUT);
$style = new SymfonyStyle($input, $output);

$style->title('LA FACTURE');

$headers = ['Description', 'Qty', 'UP'];
$rows = [];
$total = 0;
foreach ($invoice->getLines() as $line) {
    $rows[] = [
        $line->getDescription()->getAbstract(),
        $line->getQuantity()->getQuantity(),
        $line->getUnitPrice()->toString(),
    ];
    $total += $line->getQuantity()->getQuantity() * $line->getUnitPrice()->toString();
}
$rows[] = [
    '',
    'Total:',
    $total.' '.$currency->getCurrency(),
];

$style->table($headers, $rows);
