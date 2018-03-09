<?php

namespace Abacus11\Illuminate\Support;

class Booleans extends CollectionOf
{
    /**
     * Collection of booleans
     *
     * Each element of the collection is a boolean
     *
     * @param boolean[] $elements
     *
     * @throws \AssertionError
     * @throws \Exception
     * @throws \TypeError
     */
    public function __construct(array $elements = [])
    {
        parent::__construct('boolean', $elements);
    }
}