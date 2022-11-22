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
 * The AbstractRoutesLoader class.
 *
 * @author Christian Neff <christian.neff@gmail.com>
 */
abstract class AbstractRoutesLoader implements RoutesLoaderInterface
{
    protected string $metadataDir;

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
     * Gets the path to the metadata directory.
     *
     * @return string
     */
    public function getMetadataDir(): string
    {
        return $this->metadataDir;
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
}
