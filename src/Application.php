<?php
/*
 * Wumbo Framework
 * Copyright (C) 2022 Christian Neff
 *
 * Permission to use, copy, modify, and/or distribute this software for
 * any purpose with or without fee is hereby granted, provided that the
 * above copyright notice and this permission notice appear in all copies.
 */

namespace Secondtruth\Wumbo;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Secondtruth\Wumbo\Loader\Routes\RoutesLoaderInterface;
use Secondtruth\Wumbo\View\Templating\TemplatingEngineInterface;
use Secondtruth\Wumbo\View\Templating\TemplatingMiddleware;
use Slim\App as SlimApp;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequestFactory;

/**
 * The Application class.
 *
 * @author Christian Neff <christian.neff@gmail.com>
 */
class Application extends SlimApp
{
    private ?RoutesLoaderInterface $routesLoader = null;

    private ?string $cachePath = null;

    public function __construct(?ContainerInterface $container = null)
    {
        $responseFactory = new ResponseFactory();

        parent::__construct($responseFactory, $container);

        $this->addRoutingMiddleware();
        $this->addErrorMiddleware(true, true, true);

        $container = $this->getContainer();
        if ($container->has(TemplatingEngineInterface::class)) {
            $templatingEngine = $container->get(TemplatingEngineInterface::class);
            $templatingMiddleware = TemplatingMiddleware::create($this, $templatingEngine);
            $this->addMiddleware($templatingMiddleware);
        }
    }

    public function run(?ServerRequestInterface $request = null): void
    {
        $request ??= ServerRequestFactory::fromGlobals();

        $domain = $request->getUri()->getHost();

        if ($this->routesLoader && $routes = $this->routesLoader->load($domain)) {
            foreach ($routes as $route) {
                $this->map((array) $route['method'], $route['path'], $route['controller'] . ':' . $route['action']);
            }

            if ($this->cachePath) {
                $this->getRouteCollector()->setCacheFile($this->cachePath . '/routes.php');
            }
        }

        parent::run($request);
    }

    public function setRoutesLoader(RoutesLoaderInterface $routesLoader): void
    {
        $this->routesLoader = $routesLoader;
    }

    public function getRoutesLoader(): ?RoutesLoaderInterface
    {
        return $this->routesLoader;
    }

    public function setCachePath(string $path): void
    {
        $this->cachePath = $path;
    }

    public function getCachePath(): ?string
    {
        return $this->cachePath;
    }
}
