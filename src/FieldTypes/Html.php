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
            'mapped' => false,
            'html' => null,
            'view' => null,
        ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $html = $options['view'] ?? $options['html'];
        $view->vars['html'] = new Markup($html, 'UTF-8');
    }
}
