# Accessible forms

This package adds functionality to [Symfony Form](https://symfony.com/packages/Form) to help improve form accessibility. It can also be used for forms within [Laravel](https://laravel.com/).

## Why accessibility matters

The web was designed to work for everyone. Accessibility is an important part of this, ensuring your website is available to everyone, regardless of disability or access needs. 

Technically, accessibility is a set of guidelines to ensure websites and digital tools (for example, an application form or content management system) are developed to remove barriers which make them difficult or impossible to use. 

Access needs can be varied: a person may be visually impaired; they may be a keyboard-only user and not be able to use a mouse; they may have a temporary health condition that changes how they use the web; they may be in a noisy environment and unable to hear audio.
All of us have different access needs as we get older. Accessibility is also about making your website work for the future you.

Most people would agree they want to build websites that are easy to use, robust and don't exclude people. Accessibility is an important factor in achieving this on the web.

You can read and watch many great [accessibility resources on the WAI website](https://www.w3.org/WAI/fundamentals/).

## Improving form accessibility

### Validation

The best practice is to validate a form on submission. It is recommended to [avoid default HTML5 form validation](https://adrianroselli.com/2019/02/avoid-default-field-validation.html).

The [Form](../src/Form.php) class defaults to add the `novalidate` attribute to your form.

### Error messages

To notify a user of an error with their form submission:

1. Indicate an error by prefixing the document’s `title`. See [Indicate form errors in the page title](page-title.md).
2. Place an error summary at the top of the page. See [Error summary](error-summary.md).
3. Add an error message to each problematic input.

Symfony Form will automatically display an error message next to the input field. Error messages should have a unique ID and be associated with the form input via the `aria-describedby` attribute.
This is provided in the accessible form theme.

## Form options

### do_not_render

If you want to add a form field for validating request data, but you don't want to display this in your HTML form, you can use the 'do_not_render' option. 
This accepts an array of element names to not render in the form HTML. This can be useful for things like pagination, that don't appear in the main form HTML but appear as links separately on the page.

Using this example, when the form is rendered to the view template, the page form element is skipped:

```php
// Form class 
class MySearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('keywords', TextType::class)
            ->add('page', IntegerType::class, ['required' => false])
        ;
    }
}
// Controller
$form = $this->createForm(MySearchForm::class, null, ['do_not_render' => ['page']]);
```

Please note, an alternative way to achieve this is to use the [allow_extra_fields](https://symfony.com/doc/current/reference/forms/types/form.html#allow-extra-fields) option, which allows additional fields to be passed into a form, but you need to take care of validation yourself.

## Docs

- [Using accessible forms with Laravel](laravel.md)
- [Using accessible forms with Symfony](symfony.md)
- Form helpers to create a form
- Accessible form theme
- GOV.UK Design System form theme
- [Indicate form errors in the page title](page-title.md)
- [Error summary](error-summary.md)
- Every input field needs a label
- Indicate required fields
- Use field hints instead of placeholders
- Using autocomplete to hint input fields 
- [Twig helpers reference](twig.md)

## TODO - work outstanding

- [] Make error summary HTML work
- [] Update HTML form theme 
- [] Add Laravel service provider, add accessible-forms-laravel to create Laravel package loader, see https://laravel.com/docs/12.x/packages#package-discovery
- [] Add Symfony service provider
- [] Add tests
