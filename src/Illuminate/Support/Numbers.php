<?php

namespace Abacus11\Illuminate\Support;

class Numbers extends CollectionOf
{
    /**
     * Collection of numbers
     *
     * Each element of the collection is a number
     *
     * @param number[] $elements
     *
     * @throws \AssertionError
     * @throws \Exception
     * @throws \TypeError
     */
    public function __construct(array $elements = [])
    {
        parent::__construct('number', $elements);
    }
}