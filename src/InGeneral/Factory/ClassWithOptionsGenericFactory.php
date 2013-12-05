<?php

namespace InGeneral\Factory;

use InGeneral\Exception\UndefinedClassException;


/**
 * Factory class for creating generic objects.
 */
class ClassWithOptionsGenericFactory
{


    /**
     * Creates an instance of a class which gets a list of options.
     *
     * @param string $className
     * @param array $options
     * @throws Exception\UndefinedClassException
     * @return mixed
     */
    public function createInstance($className, array $options = array())
    {
        if (! class_exists($className)) {
            throw new UndefinedClassException($className);
        }
        
        $instance = new $className($options);
        
        return $instance;
    }
}