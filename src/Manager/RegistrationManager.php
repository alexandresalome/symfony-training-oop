<?php

namespace App\Manager;


use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception\TableNotFoundException;

class RegistrationManager
{
    public function getUsers(): array
    {
        $conn = DriverManager::getConnection([
            'url' => 'sqlite:///'.dirname(__DIR__, 2).'/var/data.sqlite',
        ]);

        try {
            $stmt = $conn->executeQuery('SELECT * FROM user_list');

            return $stmt->fetchAllAssociative();
        } catch (TableNotFoundException $e) {
            $conn->executeStatement('CREATE TABLE user_list (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username VARCHAR(64) NOT NULL,
                email VARCHAR(128) NOT NULL
            )');

            $stmt = $conn->executeQuery('SELECT * FROM user_list');

            return $stmt->fetchAllAssociative();
        }
    }

    public function createUser(array $data): void
    {
        $conn = DriverManager::getConnection([
            'url' => 'sqlite:///' . __DIR__ . '/../../var/data.sqlite',
        ]);

        try {
            $conn->insert('user_list', $data);
        } catch (TableNotFoundException $e) {
            $conn->executeStatement('CREATE TABLE user_list (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username VARCHAR(64) NOT NULL,
                email VARCHAR(128) NOT NULL
            )');
            $conn->insert('user_list', $data);
        }
    }
}
