<?php

namespace Metinet\Controller;

use Metinet\Students\Forms\StudentRegistrationType;
use Metinet\Students\Forms\StudentRegistration as StudentRegistrationDto;
use Metinet\Students\StudentRegistration;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentsController extends Controller
{
    public function register(Request $request, StudentRegistration $studentRegistration): Response
    {
        $studentRegistrationDto = new StudentRegistrationDto();

        $form = $this->createForm(StudentRegistrationType::class, $studentRegistrationDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $studentRegistration->register($form->getData());

            return $this->redirectToRoute('homepage');
        }

        return $this->render('students/register.html.twig', [
            'registerForm' => $form->createView()
        ]);
    }
}
