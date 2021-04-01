<?php

namespace App\Controller;

use App\Manager\RegistrationManager;
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
        $manager = new RegistrationManager();

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'users' => $manager->getUsers(),
        ]);
    }
}
