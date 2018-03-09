<?php

namespace Abacus11\Illuminate\Support;

use Abacus11\Collections\TypedCollection;
use Illuminate\Support\Collection;

class CollectionOf extends Collection implements TypedCollection
{
    use TypedCollectionTrait;

    /**
     * Initialize the array-like collection
     *
     * Without any arguments:
     * <code>
     * new CollectionOf();       // Type is undefined
     * </code>
     *
     * With a type:
     * <code>
     * new CollectionOf('integer');
     * new CollectionOf('integer', []);
     * new CollectionOf('integer', [1, 2, 3]);
     * </code>
     *
     * With an initial array:
     * <code>
     * new CollectionOf([]);     // Type is undefined
     * new CollectionOf([1, 2, 3]);
     * </code>
     *
     * With a closure:
     * <code>
     * new CollectionOf(function($i) {return is_integer($i);});
     * new CollectionOf(function($i) {return is_integer($i);}, [1, 2, 3]);
     * </code>
     *
     * @param mixed|string|\Closure $definition
     *
     * @throws \AssertionError
     * @throws \Exception
     * @throws \TypeError
     *
     * @see CollectionOf::setElementType()
     * @see CollectionOf::setElementTypeLike()
     */
    public function __construct(...$definition)
    {
        switch (count($definition)) {
            case 0:
                $type = null;
                $elements = [];
                break;
            case 1:
                if (is_string($definition[0]) || $definition[0] instanceof \Closure) {
                    $type = $definition[0];
                    $elements = [];
                } elseif ($definition[0] === null) {
                    throw new \InvalidArgumentException('Argument cannot be NULL');
                } else {
                    $type = null;
                    $elements = $this->getArrayableItems($definition[0]);
                }
                break;
            case 2:
                $type = $definition[0];
                if ($type === null) {
                    throw new \InvalidArgumentException('First argument cannot be NULL');
                }
                $elements = $this->getArrayableItems($definition[1]);
                break;
            default:
                throw new \InvalidArgumentException('Too many arguments');
        }
        if ($type !== null && !$this->isElementTypeSet()) {
            $this->setElementType($type);
        }
        if (!empty($elements)) {
            // Use the first element as type
            if (!$this->isElementTypeSet()) {
                $this->setElementTypeLike(reset($elements));
            }
            foreach ($elements as $i => $element) {
                if (!$this->isElementType($element)) {
                    throw new \TypeError('Value at position `'.$i.'` does not comply with the criteria for the collection');
                }
            }
        }
        parent::__construct($elements);
    }

    /**
     * Create a new collection instance if the value isn't one already.
     *
     * @param mixed|string|\Closure $param1 Type (string or Closure) or collection items
     * @param mixed $param2  Collection items if the first argument is a type definition
     *
     * @return static
     */
    public static function make($param1 = [], ...$param2)
    {
        return call_user_func_array(array(get_called_class(), '__construct'), ...func_get_args());
    }
}