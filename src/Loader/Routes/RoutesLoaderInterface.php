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
 * The RoutesLoader interface.
 *
 * @author Christian Neff <christian.neff@gmail.com>
 */
interface RoutesLoaderInterface
{
    /**
     * Loads the routes for the given domain.
     *
     * @param string $domain The domain name
     *
     * @return array
     */
    public function load(string $domain): array;
}
