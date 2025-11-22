# Error summary

When a form has an error you should show an error summary near the top of the page in addition to an error message next to the input field.
The error summary should link to the relevant input field.

See https://design-system.service.gov.uk/components/error-summary/

You can use [form_error_summary](twig.md#form_error_summary) to add a summary of all errors above your form, these link to the relevant input field.

You need to output this in your template separate to the form, since the aim is to place this at the top of the main content of the page, usually the `<main>` element.

Twig

```
{{ form_error_summary(form) }}
```

Blade

```
@formErrorSummary($form)
```

---
Back to [Docs index](README.md)
