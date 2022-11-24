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

interface TemplatingEngineInterface
{
    /**
     * @param RouteParserInterface $routeParser The route parser to use
     * @param UriInterface         $uri         The current URI
     * @param string               $basePath    The base path
     */
    public function prepare(RouteParserInterface $routeParser, UriInterface $uri, string $basePath = ''): void;

    /**
     * @param string $template The template name
     * @param array  $data     The template data
     *
     * @return string
     */
    public function renderTemplate(string $template, array $data = []): string;
}
