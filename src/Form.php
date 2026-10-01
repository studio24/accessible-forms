<?php

declare(strict_types=1);

namespace Studio24\AccessibleForms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Form extends AbstractType
{
    /**
     * Set default options for a form
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        // Disable HTML5 validation
        $resolver->setDefaults([
            'attr' => ['novalidate' => 'novalidate'],
            'do_not_render' => [],
        ]);

        $resolver->setAllowedTypes('do_not_render', 'array');
    }

    /**
     * @return void
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        // Remove elements we do not want to render in HTML form
        if (!empty($options['do_not_render'])) {
            foreach ($options['do_not_render'] as $element) {
                unset($view->children[$element]);
            }
        }

        parent::finishView($view, $form, $options);
    }
}
