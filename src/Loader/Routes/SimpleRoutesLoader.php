<?php
/*
 * Wumbo Framework
 * Copyright (C) 2022 Christian Neff
 *
 * Permission to use, copy, modify, and/or distribute this software for
 * any purpose with or without fee is hereby granted, provided that the
 * above copyright notice and this permission notice appear in all copies.
 */

namespace Secondtruth\Wumbo\Loader\Routes;

/**
 * The RoutesLoader class.
 *
 * @author Christian Neff <christian.neff@gmail.com>
 */
class SimpleRoutesLoader extends AbstractRoutesLoader
{
    /**
     * {@inheritdoc}
     */
    public function load(string $domain): array
    {
        $routesFile = $this->metadataDir . '/routes.php';
        
        if ($routesFile) {
            return require $routesFile;
        }
        
        return [];
    }
}
