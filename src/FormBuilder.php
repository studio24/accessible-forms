<?php

namespace Studio24\AccessibleForms;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilder as SymfonyFormBuilder;

class FormBuilder extends SymfonyFormBuilder
{
    protected bool $autoCombine = true;

    /**
     * Whether choices array should automatically be combined
     * @return bool
     */
    public function isAutoCombine(): bool
    {
        return $this->autoCombine;
    }

    /**
     * Set whether choices array should automatically be combined
     * @param bool $autoCombine
     */
    public function setAutoCombine(bool $autoCombine): void
    {
        $this->autoCombine = $autoCombine;
    }

    /**
     * Convert flat array into a suitable format for using with Symfony Form choices
     * This method copies array values to each corresponding key, only if keys are standard numeric keys
     */
    public function combine(array $choices): array
    {
        // Skip if keys have been set to a custom value, not standard numeric
        if (array_keys($choices) !== range(0, count($choices) - 1)) {
            return $choices;
        }
        return array_combine($choices, $choices);
    }

    /**
     * Adds a select input field to a form
     *
     * @param string $name Name of the field
     * @param array $choices Associative array of options, where keys are used as values and values are displayed as labels
     * @param array $rules Optional validation rules
     * @return void
     */
    public function select(string $name, array $choices, array $rules = []): void
    {
        if ($this->isAutoCombine()) {
            $choices = $this->combine($choices);
        }
        $this
            ->add($name, ChoiceType::class, ['choices' =>
                $choices,
                'expanded' => false, 'multiple' => false,
                'rules' => $rules
            ]);
    }

    /**
     * Adds a set of checkboxes to a form
     *
     * @param string $name Name of the field
     * @param array $choices Associative array of options, where keys are used as values and values are displayed as labels
     * @param array $rules Optional validation rules
     * @return void
     */
    public function checkbox(string $name, array $choices, array $rules = []): void
    {
        if ($this->isAutoCombine()) {
            $choices = $this->combine($choices);
        }
        $this
            ->add($name, ChoiceType::class, ['choices' =>
                $choices,
                'expanded' => true, 'multiple' => true,
                'rules' => $rules
            ]);
    }

    /**
     * Adds a set of radio inputs to a form
     *
     * @param string $name Name of the field
     * @param array $choices Associative array of options, where keys are used as values and values are displayed as labels
     * @param array $rules Optional validation rules
     * @return void
     */
    public function radio(string $name, array $choices, array $rules = []): void
    {
        if ($this->isAutoCombine()) {
            $choices = $this->combine($choices);
        }
        $this
            ->add($name, ChoiceType::class, ['choices' =>
                $choices,
                'expanded' => true, 'multiple' => false,
                'rules' => $rules
            ]);
    }
}
