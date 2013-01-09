<?php

namespace InGeneral\Util;


/**
 * Simple container for options.
 *
 */
class Options extends \ArrayObject
{


    /**
     * Constructor.
     *
     * @param array|\Traversable $options
     */
    public function __construct($options = null, array $defaultOptions = array())
    {
        if (null === $options) {
            $options = array();
        } else {
            $options = \Zend\Stdlib\ArrayUtils::iteratorToArray($options);
        }
        
        $options += $defaultOptions;
        
        parent::__construct($options);
    }


    /**
     * Returns the option for the corresponding key.
     *
     * @param string $key
     * @param mixed $defaultValue
     * @return mixed|NULL
     */
    public function get($key, $defaultValue = null)
    {
        if ($this->offsetExists($key)) {
            return $this->offsetGet($key);
        }
        
        if (null !== $defaultValue) {
            return $defaultValue;
        }
        
        return null;
    }


    /**
     * Sets the value to with the corresponding key.
     *
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value)
    {
        $this->offsetSet($key, $value);
    }
}