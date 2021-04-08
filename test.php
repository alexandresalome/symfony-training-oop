<?php

namespace Main;

use App\Invoice\Builder\InvoiceBuilder;
use App\Price\Price;
use App\Price\Currency;
use App\ValueComputer\Inventory;
use App\ValueComputer\ValuableInvoice;
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

$invoice = $builder->createInvoice('INV-123-foo');

$input = new ArgvInput();
$output = new StreamOutput(STDOUT);
$style = new SymfonyStyle($input, $output);

$style->title(sprintf('LA FACTURE (#%s)', $invoice->getNumber()->getNumber()));

$headers = ['Description', 'Qty', 'Unit price', 'Total price'];
$rows = [];
foreach ($invoice->getLines() as $line) {
    $rows[] = [
        $line->getDescription()->getAbstract(),
        $line->getQuantity()->getQuantity(),
        $line->getUnitPrice()->toString(),
        $line->getPrice()->toString(),
    ];
}

$style->table($headers, $rows);
$style->info(sprintf('Total: %s', $invoice->getPrice()->toString()));

$valueComputer = new Inventory([
    new ValuableInvoice($invoice),
]);

$style->info(sprintf('Total value: %s', $valueComputer->getPrice()->toString()));
