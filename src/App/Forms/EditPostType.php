<?php

namespace Metinet\App\Forms;

use Symfony\Component\OptionsResolver\OptionsResolver;

class EditPostType extends NewPostType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EditPost::class,
        ]);
    }
}
