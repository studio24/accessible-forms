# reCAPTCHA v3 field

The `RecaptchaV3` field type adds invisible [Google reCAPTCHA v3](https://developers.google.com/recaptcha/docs/v3) spam protection to a form.
It is currently Laravel only.

reCAPTCHA v3 does not ask the user to solve a challenge, so it adds no extra steps for keyboard, screen reader or other assistive technology users.

The token is requested when the form is submitted rather than when the page loads. reCAPTCHA tokens expire after 2 minutes, so fetching
one on page load would cause the form to fail for anyone who takes longer than that to complete it.

## Installation

Install [laravel-recaptchav3](https://github.com/josiasmontag/laravel-recaptchav3) via [Composer](https://getcomposer.org/):

```shell
composer require josiasmontag/laravel-recaptchav3
```

Add your keys to `.env`:

```
RECAPTCHAV3_SITEKEY=sitekey
RECAPTCHAV3_SECRET=secret
```

Load the reCAPTCHA script on any page that uses the field, for example in your layout template:

```twig
{{ recaptchaJs()|raw }}
```

Where `recaptchaJs()` is a Twig function that returns `RecaptchaV3::initJs()`.

## Usage

Add the field to your form class, usually just before the submit button:

```php
use Studio24\AccessibleForms\FieldTypes\RecaptchaV3;

$builder
    ->add('recaptcha', RecaptchaV3::class, [
        'action' => 'contact',
    ])
    ->add('save', SubmitType::class, ['label' => 'Send']);
```

The token is validated when the form is submitted via `$form->isValid()`. No extra controller code is needed.

## Options

| Option    | Default    | Description                                                                                           |
|-----------|------------|-------------------------------------------------------------------------------------------------------|
| `action`  | `submit`   | reCAPTCHA action name, shown in the reCAPTCHA admin console. Letters, numbers, `/` and `_` only.       |
| `score`   | `0.5`      | Minimum score (0.0 to 1.0) needed to pass validation.                                                 |
| `message` | See below  | Error message shown in the error summary and above the field if verification fails.                  |
| `nonce`   | `null`     | Content Security Policy nonce added to the inline `<script>`. Only added when set.                    |

The default error message is "We could not confirm this form was sent by a person. Please try submitting the form again."

### Content Security Policy

The field renders an inline `<script>`. If your Content Security Policy blocks inline scripts, pass a nonce, for example with [spatie/laravel-csp](https://github.com/spatie/laravel-csp):

```php
->add('recaptcha', RecaptchaV3::class, [
    'action' => 'contact',
    'nonce' => app('csp-nonce'),
])
```

## Accessibility notes

- If verification fails, the error is shown in the [error summary](error-summary.md). The summary link moves focus to the error message on the page.
- If the reCAPTCHA script cannot load (for example, it is blocked), the form still submits and the user sees the error message rather than a form that does nothing.
- Google requires you to tell users that the site is protected by reCAPTCHA if you hide the badge. See [hiding the badge](https://developers.google.com/recaptcha/docs/faq#id-like-to-hide-the-recaptcha-badge.-what-is-allowed).

---
Back to [Docs index](README.md)
