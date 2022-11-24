<?php
/*
 * Wumbo Framework
 * Copyright (C) 2022 Christian Neff
 *
 * Permission to use, copy, modify, and/or distribute this software for
 * any purpose with or without fee is hereby granted, provided that the
 * above copyright notice and this permission notice appear in all copies.
 */

namespace Secondtruth\Wumbo\View\Templating;

use Psr\Http\Message\UriInterface;
use Slim\Interfaces\RouteParserInterface;
use Slim\Views\Twig;
use Slim\Views\TwigRuntimeLoader;
use Twig\Error\LoaderError;

class TwigEngine implements TemplatingEngineInterface
{
    protected readonly Twig $twig;

    /**
     * Wraps a Twig instance.
     * 
     * @param Twig $twig The Twig instance
     */
    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Creates a new Engine instance from option parameters.
     *
     * @param string|string[]      $path     Path(s) to templates directory
     * @param array<string, mixed> $settings Twig environment settings
     *
     * @throws LoaderError when the template cannot be found.
     *
     * @return self
     */
    public static function create($path, array $settings = []): self
    {
        return new self(Twig::create($path, $settings));
    }

    /**
     * {@inheritdoc}
     */
    public function prepare(RouteParserInterface $routeParser, UriInterface $uri, string $basePath = ''): void
    {
        $runtimeLoader = new TwigRuntimeLoader($routeParser, $uri, $basePath);
        $this->twig->addRuntimeLoader($runtimeLoader);
    }

    /**
     * {@inheritdoc}
     */
    public function renderTemplate(string $template, array $data = []): string
    {
        return $this->twig->fetch($this->getFullTemplateName($template), $data);
    }

    /**
     * @param string $template The template name
     *
     * @return string
     */
    protected function getFullTemplateName(string $template): string
    {
        return $template . '.twig';
    }
}
