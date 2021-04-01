<?php

namespace App\Controller;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception\TableNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route(path="/", name="homepage")
     */
    public function index(): Response
    {
        try {
            $conn = DriverManager::getConnection([
                'url' => 'sqlite:///'.dirname(__DIR__, 2).'/var/data.sqlite',
            ]);

            $stmt = $conn->executeQuery('SELECT * FROM user_list');
            $users = $stmt->fetchAllAssociative();
        } catch (TableNotFoundException $e) {
            $conn->executeStatement('CREATE TABLE user_list (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username VARCHAR(64) NOT NULL,
                email VARCHAR(128) NOT NULL
            )');

            $stmt = $conn->executeQuery('SELECT * FROM user_list');
            $users = $stmt->fetchAllAssociative();
        }

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'users' => $users,
        ]);
    }
}
