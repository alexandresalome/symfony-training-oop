<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception\TableNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /**
     * @Route(path="/registration", name="registration")
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(RegistrationFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $conn = DriverManager::getConnection([
                    'url' => 'sqlite:///' . __DIR__ . '/../../var/data.sqlite',
                ]);

                $conn->insert('user_list', $form->getData());
            } catch (TableNotFoundException $e) {
                $conn->executeStatement('CREATE TABLE user_list (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    username VARCHAR(64) NOT NULL,
                    email VARCHAR(128) NOT NULL
                )');
                $conn->insert('user_list', $form->getData());
            }

            return $this->redirectToRoute('homepage');
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
