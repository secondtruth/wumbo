<?php
/*
 * Wumbo Framework
 * Copyright (C) 2022 Christian Neff
 *
 * Permission to use, copy, modify, and/or distribute this software for
 * any purpose with or without fee is hereby granted, provided that the
 * above copyright notice and this permission notice appear in all copies.
 */

namespace Secondtruth\Wumbo\Controller;

use Secondtruth\Wumbo\View\ViewInterface;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Twig\Environment;

/**
 * The AbstractController class.
 *
 * @author Christian Neff <christian.neff@gmail.com>
 */
abstract class AbstractController
{
    protected Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    protected function render(ViewInterface $view): ResponseInterface
    {
        $output = $view->render($this->twig);

        return new HtmlResponse($output);
    }
}
