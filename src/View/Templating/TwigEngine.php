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
use Secondtruth\Wumbo\View\Templating\Twig\TwigExtension;
use Secondtruth\Wumbo\View\Templating\Twig\TwigRuntimeLoader;
use Twig\Environment;
use Twig\Loader\LoaderInterface;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\ExtensionInterface;
use Twig\Error\LoaderError;

class TwigEngine implements TemplatingEngineInterface
{
    protected readonly LoaderInterface $loader;

    protected readonly Environment $environment;

    /**
     * Wraps a Twig Environment instance that is created from the given templates loader.
     *
     * @param LoaderInterface      $loader   The Twig templates loader to use
     * @param array<string, mixed> $settings Twig environment settings
     */
    public function __construct(LoaderInterface $loader, array $settings = [])
    {
        $this->loader = $loader;
        $this->environment = new Environment($this->loader, $settings);

        $extension = new TwigExtension();
        $this->addExtension($extension);
    }

    /**
     * Creates a new Engine instance from option parameters.
     *
     * @param string|string[]      $path     One or multiple templates directory path(s)
     * @param array<string, mixed> $settings Twig environment settings
     *
     * @throws LoaderError when the template cannot be found.
     *
     * @return self
     */
    public static function create(string|array $path, array $settings = []): self
    {
        $loader = new FilesystemLoader();

        $paths = is_array($path) ? $path : [$path];
        foreach ($paths as $namespace => $path) {
            if (is_string($namespace)) {
                $loader->setPaths($path, $namespace);
            } else {
                $loader->addPath($path);
            }
        }

        return new self($loader, $settings);
    }

    /**
     * Returns the Twig loader
     *
     * @return LoaderInterface
     */
    public function getLoader(): LoaderInterface
    {
        return $this->loader;
    }

    /**
     * Returns the Twig environment
     *
     * @return Environment
     */
    public function getEnvironment(): Environment
    {
        return $this->environment;
    }

    /**
     * Proxy method to add an extension to the Twig environment
     *
     * @param ExtensionInterface $extension A single extension instance or an array of instances
     */
    public function addExtension(ExtensionInterface $extension): void
    {
        $this->environment->addExtension($extension);
    }

    /**
     * {@inheritdoc}
     */
    public function prepare(RouteParserInterface $routeParser, UriInterface $uri, string $basePath = ''): void
    {
        $runtimeLoader = new TwigRuntimeLoader($routeParser, $uri, $basePath);
        $this->environment->addRuntimeLoader($runtimeLoader);
    }

    /**
     * {@inheritdoc}
     */
    public function renderTemplate(string $template, array $data = []): string
    {
        return $this->environment->render($this->getFullTemplateName($template), $data);
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
