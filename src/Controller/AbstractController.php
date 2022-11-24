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
use Secondtruth\Wumbo\View\Templating\TemplatingEngineInterface;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response\HtmlResponse;

/**
 * The AbstractController class.
 *
 * @author Christian Neff <christian.neff@gmail.com>
 */
abstract class AbstractController
{
    protected TemplatingEngineInterface $templatingEngine;

    public function __construct(TemplatingEngineInterface $templatingEngine)
    {
        $this->templatingEngine = $templatingEngine;
    }

    protected function render(ViewInterface $view, array $extraData = []): ResponseInterface
    {
        $response = new HtmlResponse('');

        return $view->render($response, $this->templatingEngine, $extraData);
    }
}
