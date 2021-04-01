<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Manager\RegistrationManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /**
     * @Route(path="/registration", name="registration")
     */
    public function index(RegistrationManagerInterface $manager, Request $request): Response
    {
        $form = $this->createForm(RegistrationFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $manager->createUser($data['username'], $data['email']);

            return $this->redirectToRoute('homepage');
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
