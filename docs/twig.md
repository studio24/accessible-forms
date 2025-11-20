# Twig template helpers

## Functions

### form_all_errors

You can return all form error as an array of errors with `form_all_errors`.

```
{% set all_errors = form_all_errors(form) %}
```

### form_error_count

You can return the total number of errors in a form via `form_all_errors_count`.

```
This form has {{ form_error_count(form) }} errors.
```

### form_error_summary

`form_error_summary` generates a block of HTML summarising all the errors in your form, linking to each form element.

```
{{ form_error_summary(form) }}
```

See https://design-system.service.gov.uk/components/error-summary/

## Filters

### prefix_on_errors

You can use `prefix_on_errors` to prefix a message if the passed form fails validation. This is useful to change the page title if the submitted form has errors.

```
<title>{{  "Page title" | prefix_on_errors(form) }}</title>
```

Results in a page title of:
```
<title>Error: Page title</title>
```

You can customise the message prefixed on validation errors. The placeholder `{count}` is replaced with the total count of errors in the form.

```
<title>{{  "Page title" | prefix_on_errors(form, 'This form has {count} errrors: ') }}</title>
```

Results in:

```
<title>This form has 3 errrors: Page title</title>
```
See https://design-system.service.gov.uk/patterns/validation/

## Tests

### valid

`valid` checks whether a form is valid or not. 

```
{% if form is not valid %}
    This form has {{ form_error_count(form) }} errors
{% endif %}
```
