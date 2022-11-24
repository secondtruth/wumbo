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
use Secondtruth\Wumbo\View\Templating\Plates\PlatesExtension;
use League\Plates\Engine;

class PlatesEngine implements TemplatingEngineInterface
{
    protected readonly Engine $engine;

    /**
     * Wraps a Plates Engine instance.
     *
     * @param Engine $engine The Plates Engine instance
     */
    public function __construct(Engine $engine = null)
    {
        $this->engine = $engine;
    }

    /**
     * Creates a new Engine instance from option parameters.
     *
     * @param string|null          $path          The path to the templates directory
     * @param array<string, mixed> $fileExtension The file extension of the templates
     *
     * @return self
     */
    public static function create(?string $path, ?string $fileExtension = null): self
    {
        return new self(new Engine($path, $fileExtension ?? 'php'));
    }

    /**
     * {@inheritdoc}
     */
    public function prepare(RouteParserInterface $routeParser, UriInterface $uri, string $basePath = ''): void
    {
        $extension = new PlatesExtension($routeParser, $uri, $basePath);
        $this->engine->loadExtension($extension);
    }

    /**
     * {@inheritdoc}
     */
    public function renderTemplate(string $template, array $data = []): string
    {
        return $this->engine->render($template, $data);
    }
}
