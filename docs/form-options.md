# Form options

## do_not_render

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
