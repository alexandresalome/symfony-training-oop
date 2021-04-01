<?php

namespace App\Manager;

class JsonFileRegistrationManager implements RegistrationManagerInterface
{
    private string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function getUsers(): array
    {
        return $this->read();
    }

    public function createUser(string $username, string $email): void
    {
        $data = $this->read();
        $data[] = ['id' => count($data) + 1, 'username' => $username, 'email' => $email];
        $this->write($data);
    }

    private function read(): array
    {
        if (!file_exists($this->file)) {
            return [];
        }

        return json_decode(file_get_contents($this->file), true, 512, JSON_THROW_ON_ERROR);
    }

    private function write(array $data): void
    {
        if (!file_exists($this->file) && !is_dir($dir = dirname($this->file))) {
            mkdir($dir, 0777, true);
        }

        file_put_contents($this->file, json_encode($data, JSON_THROW_ON_ERROR));
    }
}
