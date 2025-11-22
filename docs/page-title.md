# Indicate form errors in the page title

You can indicate a form has failed validation by prefixing the document’s `title`. It’s the first thing announced by screen readers when the page loads.

See https://design-system.service.gov.uk/patterns/validation/

You can use the Twig filter [prefix_on_errors](twig.md#prefix_on_errors) to update the title on form errors.

```
<title>{{  "Page title" | prefix_on_errors(form) }}</title>
```

Results in a page title of:
```
<title>Error: Page title</title>
```

You can customise the message prefixed on validation errors. The placeholder `{count}` is replaced with the total count of errors in the form.

```
<title>{{  "Page title" | prefix_on_errors(form, 'There are {count} problems with this request: ') }}</title>
```

Results in:

```
<title>This form has 3 errrors: Page title</title>
```

You can also use the [valid](twig.md#valid) test:

```
<title>
    {%- if form is not valid -%}
         There are {{ form_error_count(form) }} problems with this request: 
    {%- endif -%}
    Page title
</title>
```

---
Back to [Docs index](README.md)
