# Accessible forms

[![Latest Version on Packagist](https://img.shields.io/packagist/v/studio24/accessible-forms.svg?style=flat-square)](https://packagist.org/packages/studio24/accessible-forms)
[![Tests](https://img.shields.io/github/actions/workflow/status/studio24/accessible-forms/php.yml?branch=main&label=tests&style=flat-square)](https://github.com/studio24/accessible-forms/actions/workflows/php.yml)

Accessible forms in Laravel and Symfony.

## Todo

Add any notes here on problems to solve:

- What helpers do we need to make form generation easier?
- Twig in Barryvdh\Form appears to be installed separately to TwigBridge - is this an issue? Twig extension appears to be available for both.
- Can we automate adding the template paths, currently copy config/form.php across

## Requirements

* PHP 8.2+

## Installation

You can install the package via [Composer](https://getcomposer.org/):

```shell
composer require studio24/accessible-forms
```

### Local install
During testing you can install this from a local copy via:

```shell
composer config repositories.local path "~/Sites/studio24/accessible-forms/"
composer require studio24/accessible-forms:dev-main
```

To remove this after testing:

```shell
ddev composer config repositories.local --unset
ddev composer update
```

See https://github.com/studio24/dev-playbook/blob/main/composer/testing-local-packages.md

## Usage

### Laravel

Add the service provider to `bootstrap/providers.php`

```php
return [
    Barryvdh\Form\ServiceProvider::class,
];
```

To enable TwigExtension in your normal Twig templates (not form twig templates at present) edit `config/twibridge.php`

```php
return [
    'extensions' => [
        'enabled' => [
            'Studio24\AccessibleForms\Twig\AccessibleFormsExtension',
        ],
    ],
];
```

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

## Testing

```shell
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Find out more about [how to contribute](CONTRIBUTING.md) and our [Code of Conduct](CODE_OF_CONDUCT.md).

## Security Issues

If you discover a security vulnerability within this package, please follow our [disclosure procedure](SECURITY.md).

## About

This package is developed by [Studio 24](https://www.studio24.net/), a human-centered digital agency who build websites and web apps that work for everyone.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
