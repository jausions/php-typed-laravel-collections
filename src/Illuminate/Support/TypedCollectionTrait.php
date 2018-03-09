<?php

namespace Abacus11\Illuminate\Support;

/**
 * Trait to implement constraints on elements of a Laravel collection
 *
 * @author Philippe Jausions <Philippe.Jausions@11abacus.com>
 * @see \Illuminate\Support\Collection
 */
trait TypedCollectionTrait
{
    use \Abacus11\Collections\TypedCollectionTrait;

    /**
     * Set the item at a given offset.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        if (!$this->isElementType($value)) {
            throw new \TypeError("The value does not comply with the criteria for the collection.");
        }
        parent::offsetSet($key, $value);
    }

    /**
     * Pad collection to the specified length with a value.
     *
     * @param  int  $size
     * @param  mixed  $value
     * @return static
     */
    public function pad($size, $value)
    {
        if (!$this->isElementType($value)) {
            throw new \TypeError('The value does not comply with the criteria for the collection.');
        }
        return parent::page($size, $value);
    }
}