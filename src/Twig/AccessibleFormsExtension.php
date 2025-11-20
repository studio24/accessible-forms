<?php
declare(strict_types=1);

namespace Studio24\AccessibleForms\Twig;

use Symfony\Bridge\Twig\Node\RenderBlockNode;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormView;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\TwigTest;

/**
 * Form helpers
 *
 * Form validity stored in formView.vars.valid
 * Form errors stored in formView.children.vars.errors
 */
class AccessibleFormsExtension extends AbstractExtension
{
    public function getTests(): array
    {
        return [
            new TwigTest('valid', [$this, 'valid']),
        ];
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('prefix_on_errors', [$this, 'prefixOnErrors']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('form_all_errors', [$this, 'allErrors']),
            new TwigFunction('form_all_errors_count', [$this, 'allErrorsCount']),
            new TwigFunction('form_error_summary', null, ['node_class' => RenderBlockNode::class, 'is_safe' => ['html']]),
        ];
    }

    public function valid(FormView $form): bool
    {
        return $form->vars['valid'];
    }

    public function allErrors(FormView $form): array
    {
        if ($this->valid($form)) {
            return [];
        }
        if (isset($form->vars['children_errors'])) {
            return $form->vars['children_errors'];
        }
        $errors = [];
        foreach ($form->children as $child) {
            if (isset($child->vars['errors']) && count($child->vars['errors']) > 0) {
                $errors[] = [
                    'id' => $child->vars['id'],
                    'name' => $child->vars['full_name'],
                    'message' => (string) $child->vars['errors']
                ];
            }
        }
        $form->vars['children_errors'] = $errors;
        return $errors;
    }

    public function allErrorsCount(): int
    {
        return count($this->allErrors());
    }

    public function errorsSummary(FormView $form): string
    {
        $html = '<p>There are {count} problems with this request</p><ul class="error-summary">';
        foreach ($this->allErrors($form) as $errors) {
            foreach ($errors as $error) {
                $html .= '<li>' . $error->getMessage() . '</li>';
            }
        }
        $html .= '</ul>';
        return $html;
    }


    public function prefixOnErrors(string $string, FormView $form, string $prefix = 'Error: '): string
    {
        if (!$this->valid($form)) {
            $string = $prefix . $string;

            // Replace {count} with the number of form errors
            if (str_contains($string, '{count}')) {
                $string = str_replace('{count}', (string) count($this->allErrors($form)), $string);
            }
        }
        return $string;
    }

}
