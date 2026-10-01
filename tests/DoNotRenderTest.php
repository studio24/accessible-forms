<?php

declare(strict_types=1);

namespace Studio24\AccessibleForms\Tests;

use Studio24\AccessibleForms\Form;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Test\TypeTestCase;

class DoNotRenderTestForm extends Form {

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('keywords', TextType::class)
            ->add('filters', ChoiceType::class, [
                'choices' => ['Yellow' => 'Yellow', 'Orange' => 'Orange', 'White' => 'White'],
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('page', IntegerType::class, ['required' => false])
        ;
    }
}

/**
 * Checks that fields listed in the `do_not_render` option are excluded from the
 * actual rendered HTML output, not just removed from the FormView tree.
 *
 * @see https://docs.phpunit.de/en/12.4/writing-tests-for-phpunit.html
 */
class DoNotRenderTest extends TypeTestCase
{
    use TwigTrait;

    public function testDoNotRenderExcludesFieldFromHtml()
    {
        $options = [
            'do_not_render' => ['page']
        ];
        $form = $this->factory->create(DoNotRenderTestForm::class, null, $options);
        $view = $form->createView();
        $html = $this->renderForm($view);

        /**
         * Form element HTML is expected to be:
         * <input type="number" id="do_not_render_test_form_page" name="do_not_render_test_form[page]" class="tbxforms-input" />
         */
        $this->assertStringNotContainsString('<input type="number" id="do_not_render_test_form_page"', $html);
    }

}
