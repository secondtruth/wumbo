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
class RoutesLoader implements RoutesLoaderInterface
{
    private string $metadataDir;

    private array $sites = [];

    /**
     * Constructs a routes loader.
     *
     * @param string $metadataDir The path to the metadata directory
     */
    public function __construct(string $metadataDir)
    {
        $this->setMetadataDir($metadataDir);
    }

    /**
     * Sets the path to the metadata directory.
     *
     * @param string $metadataDir The path to the metadata directory
     */
    public function setMetadataDir(string $metadataDir): void
    {
        if (!is_dir($metadataDir)) {
            throw new \InvalidArgumentException('Metadata directory does not exist');
        }

        $this->metadataDir = realpath($metadataDir);
    }

    /**
     * Registers a site with the given domain.
     *
     * @param string      $domain     The domain name
     * @param string|null $routesFile An alternative routes file path
     */
    public function registerSite(string $domain, ?string $routesFile = null): void
    {
        $domain = strtolower($domain);

        if (isset($this->sites[$domain])) {
            throw new \InvalidArgumentException(sprintf('Site "%s" already registered', $domain));
        }

        $routesFile ??= $this->metadataDir . '/' . $domain . '/routes.php';

        if (!is_file($routesFile)) {
            throw new \InvalidArgumentException('Routes file does not exist');
        }

        $this->sites[$domain] = realpath($routesFile);
    }

    /**
     * {@inheritdoc}
     */
    public function load(string $domain): array
    {
        $routesFile = $this->sites[$domain] ?? null;
        
        if ($routesFile) {
            return require $routesFile;
        }
        
        return [];
    }
}
