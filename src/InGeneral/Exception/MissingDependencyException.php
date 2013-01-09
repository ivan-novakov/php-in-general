<?php

namespace InGeneral\Exception;


/**
 * Exception thrown, when an object detects unresolved or missing dependency.
 *
 */
class MissingDependencyException extends \RuntimeException
{


    public function __construct($dependency, $object)
    {
        parent::__construct(
            sprintf("Missing dependency '%s' for '%s'", $dependency, is_object($object) ? get_class($object) : $object));
    }
}