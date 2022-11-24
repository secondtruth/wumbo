<?php
/*
 * Wumbo Framework
 * Copyright (C) 2022 Christian Neff
 *
 * Permission to use, copy, modify, and/or distribute this software for
 * any purpose with or without fee is hereby granted, provided that the
 * above copyright notice and this permission notice appear in all copies.
 */

namespace Secondtruth\Wumbo\View;

use Psr\Http\Message\ResponseInterface;
use Secondtruth\Wumbo\View\Templating\TemplatingEngineInterface;

/**
 * The View class.
 *
 * @author Christian Neff <christian.neff@gmail.com>
 */
class View implements ViewInterface
{
    protected string $name;

    protected array $data = [];

    /**
     * Constructs a View object.
     *
     * @param string $name The name of the view
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $name, $value): void
    {
        $this->data[$name] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function setMultiple(array $data): void
    {
        $this->data = array_merge($this->data, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function render(ResponseInterface $response, TemplatingEngineInterface $engine, array $extraData = []): ResponseInterface
    {
        $output = $engine->renderTemplate($this->name, array_merge($this->data, $extraData));
        $response->getBody()->write($output);

        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplateName(): string
    {
        return $this->name . '.twig';
    }
}
