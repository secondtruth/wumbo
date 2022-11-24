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
 * The View interface.
 *
 * @author Christian Neff <christian.neff@gmail.com>
 */
interface ViewInterface
{
    /**
     * Renders the view.
     *
     * @param Environment $twig The Twig environment
     *
     * @return string
     */
    public function render(Environment $twig): string;

    /**
     * Gets the defined variables.
     *
     * @return array<string, mixed>
     */
    public function getVariables(): array;

    /**
     * Sets a variable with the given value.
     *
     * @param string $name  The name of the variable
     * @param mixed  $value The value of the variable
     */
    public function set(string $name, $value): void;

    /**
     * Sets multiple variables.
     *
     * @param array $data The variables
     */
    public function setMultiple(array $data): void;

    /**
     * Returns the name of the view.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Returns the full template name for the view.
     *
     * @return string
     */
    public function getTemplateName(): string;
}
