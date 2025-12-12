# Using accessible forms with Laravel

## Installation

Install this package and [Laravel Form Bridge](https://github.com/barryvdh/laravel-form-bridge) via [Composer](https://getcomposer.org/):

```shell
composer require studio24/accessible-forms
composer require barryvdh/laravel-form-bridge
```

Add the service provider to `bootstrap/providers.php`

```php
return [
    Barryvdh\Form\ServiceProvider::class,
];
```

Enable the custom Twig helpers by editing `config/twigbridge.php`

```php
return [
    'extensions' => [
        'enabled' => [
            'Studio24\AccessibleForms\Twig\AccessibleFormsExtension',
        ],
    ],
];
```

Copy config:

```shell
cp vendor/studio24/accessible-forms/config/form.php config/form.php
php artisan cache:clear
```

## Usage

Create a form class:

See https://symfony.com/doc/current/forms.html#creating-form-classes

The form processing workflow is:

1. Display form
2. Form submitted via POST request
3. Form request data is validated
4. If pass validation, do something, and redirect to success page
5. If fail validation, redisplay form with validation messages (and no redirect)

Add form processing code to your controller:

```php
$form = $this->createForm(ContactForm::class);

$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
    // Do something, e.g. save data
    return 'Form submitted successfully';
}

// Display form to user, with validation if submitted and fails validation
return view('template-name', ['form' => $form->createView()]);
```

---
Back to [Docs index](README.md)
