<?php

namespace App\Controller;

use App\Manager\RegistrationManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route(path="/", name="homepage")
     */
    public function index(RegistrationManagerInterface $manager): Response
    {
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'users' => $manager->getUsers(),
        ]);
    }
}
