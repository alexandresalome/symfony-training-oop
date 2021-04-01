<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Manager\RegistrationManager;
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
        $manager = new RegistrationManager();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->createUser($form->getData());

            return $this->redirectToRoute('homepage');
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
