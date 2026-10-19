<?php

namespace Studio24\AccessibleForms\FieldTypes;

use Studio24\AccessibleForms\Validation\RecaptchaV3Rule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Invisible reCAPTCHA v3 field
 *
 * The token is requested when the form is submitted (not on page load), so it cannot
 * expire while someone is still filling in the form. Requires josiasmontag/laravel-recaptchav3
 */
class RecaptchaV3 extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'mapped' => false,
            'required' => false,
            'label' => false,
            'error_bubbling' => false,
            'action' => 'submit',
            'score' => 0.5,
            'message' => 'We could not confirm this form was sent by a person. Please try submitting the form again.',
            'rules' => function (Options $options) {
                return [new RecaptchaV3Rule($options['action'], (float) $options['score'], $options['message'])];
            },
        ]);

        // Google only allows alphanumerics, slashes and underscores in action names
        $resolver->setAllowedTypes('action', 'string');
        $resolver->setAllowedValues('action', fn (string $action) => preg_match('/^[A-Za-z0-9_\/]+$/', $action) === 1);
        $resolver->setAllowedTypes('score', ['int', 'float']);
        $resolver->setAllowedTypes('message', 'string');
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['action'] = $options['action'];
        $view->vars['sitekey'] = config('recaptchav3.sitekey');
    }

    public function getParent(): string
    {
        return HiddenType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'recaptcha_v3';
    }
}
