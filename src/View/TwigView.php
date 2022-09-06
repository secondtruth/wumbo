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

use Twig\Environment;

/**
 * The TwigView class.
 *
 * @author Christian Neff <christian.neff@gmail.com>
 */
class TwigView implements ViewInterface
{
    private string $name;

    private array $data = [];

    /**
     * Constructs a view.
     *
     * @param string $name The name of the view
     * @param string $path The path to the views
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function render(Environment $twig): string
    {
        return $twig->render($this->getTemplateName(), $this->data);
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
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getTemplateName(): string
    {
        return $this->name . '.twig';
    }
}
