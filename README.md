# Accessible forms

[![Latest Version on Packagist](https://img.shields.io/packagist/v/studio24/accessible-forms.svg?style=flat-square)](https://packagist.org/packages/studio24/accessible-forms)
[![Tests](https://img.shields.io/github/actions/workflow/status/studio24/accessible-forms/php.yml?branch=main&label=tests&style=flat-square)](https://github.com/studio24/accessible-forms/actions/workflows/php.yml)

Create more accessible forms in your PHP apps.

## What does this library do?

This library helps you create accessible forms within your PHP app. It uses [Symfony Form](https://symfony.com/packages/Form) 
as the underlying form library. 

It includes:

- Accessible form themes 
- Support for the [GOV.UK Design System](https://design-system.service.gov.uk/)
- Error summary block
- Update page titles on form validation errors

Each feature is explained in the [docs](docs/README.md). Usage instructions for Symfony and Laravel are included.

## Requirements

* PHP 8.2+

## Installation

You can install the package via [Composer](https://getcomposer.org/):

```shell
composer require studio24/accessible-forms
```

### Local install (remove this on release)
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
