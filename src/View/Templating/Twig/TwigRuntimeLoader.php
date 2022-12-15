<?php
/*
 * Wumbo Framework
 * Copyright (C) 2022 Christian Neff
 *
 * Permission to use, copy, modify, and/or distribute this software for
 * any purpose with or without fee is hereby granted, provided that the
 * above copyright notice and this permission notice appear in all copies.
 */

namespace Secondtruth\Wumbo\View\Templating\Twig;

use Psr\Http\Message\UriInterface;
use Slim\Interfaces\RouteParserInterface;
use Twig\RuntimeLoader\RuntimeLoaderInterface;

class TwigRuntimeLoader implements RuntimeLoaderInterface
{
    protected RouteParserInterface $routeParser;

    protected UriInterface $uri;

    protected string $basePath = '';

    /**
     * TwigRuntimeLoader constructor.
     *
     * @param RouteParserInterface $routeParser
     * @param UriInterface         $uri
     * @param string               $basePath
     */
    public function __construct(RouteParserInterface $routeParser, UriInterface $uri, string $basePath = '')
    {
        $this->routeParser = $routeParser;
        $this->uri = $uri;
        $this->basePath = $basePath;
    }

    /**
     * Create the runtime implementation of a Twig element.
     *
     * @param string $class
     *
     * @return mixed
     */
    public function load(string $class)
    {
        if (TwigRuntimeExtension::class === $class) {
            return new $class($this->routeParser, $this->uri, $this->basePath);
        }

        return null;
    }
}
