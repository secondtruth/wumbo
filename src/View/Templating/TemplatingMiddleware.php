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

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Secondtruth\Wumbo\View\Templating\TemplatingEngineInterface;
use Slim\App;
use Slim\Interfaces\RouteParserInterface;

class TemplatingMiddleware implements MiddlewareInterface
{
    protected TemplatingEngineInterface $engine;

    protected RouteParserInterface $routeParser;

    protected string $basePath;

    /**
     * @param App                       $app    The Slim application
     * @param TemplatingEngineInterface $engine The templating engine to use
     *
     * @return self
     */
    public static function create(App $app, TemplatingEngineInterface $engine): self
    {
        return new self(
            $engine,
            $app->getRouteCollector()->getRouteParser(),
            $app->getBasePath()
        );
    }

    /**
     * @param TemplatingEngineInterface $engine      The templating engine to use
     * @param RouteParserInterface      $routeParser The route parser to use
     * @param string                    $basePath    The base path
     */
    public function __construct(TemplatingEngineInterface $engine, RouteParserInterface $routeParser, string $basePath = '')
    {
        $this->engine = $engine;
        $this->routeParser = $routeParser;
        $this->basePath = $basePath;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->engine->prepare($this->routeParser, $request->getUri(), $this->basePath);

        return $handler->handle($request);
    }
}
