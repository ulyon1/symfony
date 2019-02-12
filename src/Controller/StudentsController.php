<?php

namespace Metinet\Controller;

use Metinet\Students\Forms\StudentRegistrationType;
use Metinet\Students\StudentRegistration;
use Metinet\Students\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentsController extends Controller
{
    public function register(Request $request, StudentRegistration $studentRegistration): Response
    {
        $form = $this->createForm(StudentRegistrationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $studentRegistrationDto = $form->getData();
            $studentRegistration->register($studentRegistrationDto);

            return $this->redirectToRoute('students_view_profile', ['id' => $studentRegistrationDto->id]);
        }

        return $this->render('students/register.html.twig', [
            'registerForm' => $form->createView()
        ]);
    }

    public function viewProfile(string $id, StudentRepository $studentRepository): Response
    {
        return $this->render('students/profile.html.twig', ['student' => $studentRepository->get($id)]);
    }
}
