<?php
declare(strict_types=1);

namespace Studio24\AccessibleForms\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AccessibleFormsExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('validation_message', [$this, 'validationMessage']),
        ];
    }

    public function validationMessage(string $title): string
    {
        // @todo process this message based on form validation
        return "There are X problems with your request - " . $title;
    }

}
