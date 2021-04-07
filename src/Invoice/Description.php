<?php

namespace App\Invoice;

class Description
{
    private string $description;

    public function __construct(string $description)
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAbstract(): string
    {
        if (strlen($this->description) > 64) {
            return substr($this->description, 0, 64).'...';
        }

        return $this->description;
    }
}
