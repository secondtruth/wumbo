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
class TwigView extends AbstractView
{
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
    public function getTemplateName(): string
    {
        return $this->name . '.twig';
    }
}
