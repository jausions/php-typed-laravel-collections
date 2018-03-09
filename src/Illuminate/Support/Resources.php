<?php

namespace Abacus11\Illuminate\Support;

class Resources extends CollectionOf
{
    /**
     * Collection of resources
     *
     * Each element of the collection is a resource
     *
     * @param resource[] $elements
     *
     * @throws \AssertionError
     * @throws \Exception
     * @throws \TypeError
     */
    public function __construct(array $elements = [])
    {
        parent::__construct('resource', $elements);
    }
}