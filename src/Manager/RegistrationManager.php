<?php

namespace App\Manager;


use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception\TableNotFoundException;

class RegistrationManager
{
    private Connection $connection;

    public function __construct()
    {
        $this->connection = $this->createConnection();
    }

    public function getUsers(): array
    {
        try {
            $stmt = $this->connection->executeQuery('SELECT * FROM user_list');

            return $stmt->fetchAllAssociative();
        } catch (TableNotFoundException $e) {
            $this->connection->executeStatement('CREATE TABLE user_list (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username VARCHAR(64) NOT NULL,
                email VARCHAR(128) NOT NULL
            )');

            $stmt = $this->connection->executeQuery('SELECT * FROM user_list');

            return $stmt->fetchAllAssociative();
        }
    }

    public function createUser(array $data): void
    {
        $this->connection = $this->createConnection();

        try {
            $this->connection->insert('user_list', $data);
        } catch (TableNotFoundException $e) {
            $this->connection->executeStatement('CREATE TABLE user_list (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username VARCHAR(64) NOT NULL,
                email VARCHAR(128) NOT NULL
            )');
            $this->connection->insert('user_list', $data);
        }
    }

    private function createConnection(): Connection
    {
        return DriverManager::getConnection([
            'url' => 'sqlite:///'.dirname(__DIR__, 2).'/var/data.sqlite',
        ]);
    }
}
