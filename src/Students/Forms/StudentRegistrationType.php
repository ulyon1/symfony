<?php

namespace Metinet\Students\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

class StudentRegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'firstName',
                TextType::class,
                [
                    'constraints' => [
                        new Length(['min' => 3, 'max' =>  100])
                    ]
                ]
            )
            ->add('lastName', TextType::class)
            ->add(
                'email',
                EmailType::class,
                [
                    'constraints' => [
                        new Email()
                    ]
                ]
            )
            ->add('yearOfEntry', TextType::class)
            ->add('Register', SubmitType::class)
        ;
    }
}