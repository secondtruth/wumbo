<?php
/*
 * Wumbo Framework
 * Copyright (C) 2022 Christian Neff
 *
 * Permission to use, copy, modify, and/or distribute this software for
 * any purpose with or without fee is hereby granted, provided that the
 * above copyright notice and this permission notice appear in all copies.
 */

namespace Secondtruth\Wumbo\View\Templating\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'slim';
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('url_for', [TwigRuntimeExtension::class, 'urlFor']),
            new TwigFunction('full_url_for', [TwigRuntimeExtension::class, 'fullUrlFor']),
            new TwigFunction('is_current_url', [TwigRuntimeExtension::class, 'isCurrentUrl']),
            new TwigFunction('current_url', [TwigRuntimeExtension::class, 'getCurrentUrl']),
            new TwigFunction('get_uri', [TwigRuntimeExtension::class, 'getUri']),
            new TwigFunction('base_path', [TwigRuntimeExtension::class, 'getBasePath']),
        ];
    }
}
