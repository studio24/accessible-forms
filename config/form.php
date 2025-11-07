<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Form theme
    |--------------------------------------------------------------------------
    |
    | Set the template to render the form.
    |
    | See https://symfony.com/doc/current/form/form_themes.html
    */
    'theme' => 'accessible-forms.html.twig',

    /*
    |--------------------------------------------------------------------------
    | Form template directories
    |--------------------------------------------------------------------------
    |
    | Add custom template directories to render the form.
    |
    | See http://symfony.com/doc/current/form/form_customization.html
    */
    'template_directories' => [
        __DIR__ . '/../vendor/studio24/accessible-forms/src/Resources/views/form'
    ],

    'defaults' => [
        'required' => true,
    ]
];
