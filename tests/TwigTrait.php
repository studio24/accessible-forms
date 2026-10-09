<?php

declare(strict_types=1);

namespace Studio24\AccessibleForms\Tests;

use Studio24\AccessibleForms\Twig\AccessibleFormsExtension;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\FormRenderer;
use Symfony\Component\Form\FormView;
use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Twig\Loader\ChainLoader;
use Twig\Loader\FilesystemLoader;
use Twig\RuntimeLoader\FactoryRuntimeLoader;

/**
 * Class to help test Twig template functionality
 */
trait TwigTrait
{
    /**
     * Render a form's FormView through the library's accessible-forms Twig theme
     */
    public function renderForm(FormView $view): string
    {
        $loader = new ChainLoader([
            new ArrayLoader(['index.html.twig' => '{{ form(view) }}']),
            new FilesystemLoader([
                __DIR__ . '/../vendor/symfony/twig-bridge/Resources/views/Form',
                __DIR__ . '/../src/Resources/views/Form',
            ]),
        ]);

        $twig = new Environment($loader);
        $twig->addExtension(new AccessibleFormsExtension());
        $twig->addExtension(new FormExtension());
        $twig->addExtension(new TranslationExtension());

        $renderer = new FormRenderer(new TwigRendererEngine(['accessible-forms.html.twig'], $twig));
        $twig->addRuntimeLoader(new FactoryRuntimeLoader([
            FormRenderer::class => fn () => $renderer,
        ]));

        return $twig->render('index.html.twig', ['view' => $view]);
    }
}
