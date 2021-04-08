<?php

namespace App\Invoice;

use Symfony\Component\Console\Style\StyleInterface;

class InvoiceRenderer
{
    private StyleInterface $style;

    public function __construct(StyleInterface $style)
    {
        $this->style = $style;
    }

    public function render(Invoice $invoice): void
    {
        $this->style->title('LA FACTURE');

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

        $this->style->table($headers, $rows);
        $this->style->info(sprintf('Total: %s', $invoice->getPrice()->toString()));
    }
}
