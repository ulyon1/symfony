<?php

namespace Metinet\App\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentRegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, ['label' => 'student_registration_form.label.firstName'])
            ->add('lastName', TextType::class, ['label' => 'student_registration_form.label.lastName'])
            ->add('email', EmailType::class, ['label' => 'student_registration_form.label.email'])
            ->add('password',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'first_options'  => ['label' => 'student_registration_form.label.password'],
                    'second_options' => ['label' => 'student_registration_form.label.password_confirmation'],
                ]
            )
            ->add('yearOfEntry', TextType::class, ['label' => 'student_registration_form.label.year_of_entry'])
            ->add('Register', SubmitType::class, ['label' => 'student_registration_form.button.submit'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StudentRegistration::class,
        ]);
    }
}
