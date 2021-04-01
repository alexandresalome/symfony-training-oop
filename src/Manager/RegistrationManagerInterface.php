<?php

namespace App\Manager;

interface RegistrationManagerInterface
{
    /**
     * @return array{id, username: string, email: string}
     */
    public function getUsers(): array;

    public function createUser(string $username, string $email): void;
}
