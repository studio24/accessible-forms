<?php

namespace Studio24\AccessibleForms\FieldTypes;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Markup;

class Html extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'html' => null,
            'view' => null
        ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['html'] = $options['html'];

        // Load in template as Twig\Markup object.
        if (!empty($options['view'])) {
            $view->vars['html'] = new Markup($options['view'], 'UTF-8');
        }
    }
}
