<?php

namespace App\Manager;

class SingletonManager
{
    private static array $instances = [];

    private ?string $name = null;

    private function __construct()
    {
    }

    public static function getInstance(string $name = 'default'): self
    {
        if (!isset(self::$instances[$name])) {
            self::$instances[$name] = new self();
        }

        return self::$instances[$name];
    }

    public function getAppName(): string
    {
        if (null === $this->name) {
            $this->name = self::compute();
        }

        return $this->name;
    }

    public static function compute(): string
    {
        return random_int(0, 100);
    }
}
