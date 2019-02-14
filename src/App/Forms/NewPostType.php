<?php

namespace Metinet\App\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class NewPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    'constraints' => [
                        new Length(['min' => 3, 'max' =>  255])
                    ],
                    'label' => 'blog_post_form.label.title'
                ]
            )
            ->add('body', TextareaType::class, ['label' => 'blog_post_form.label.body'])
            ->add('Submit', SubmitType::class, ['label' => 'blog_post_form.button.submit'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NewPost::class,
        ]);
    }
}
