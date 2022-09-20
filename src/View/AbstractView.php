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

/**
 * The AbstractView class.
 *
 * @author Christian Neff <christian.neff@gmail.com>
 */
abstract class AbstractView implements ViewInterface
{
    protected string $name;

    protected array $data = [];

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
}
