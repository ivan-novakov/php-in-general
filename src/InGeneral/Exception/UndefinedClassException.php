<?php

namespace InGeneral\Exception;


class UndefinedClassException extends \RuntimeException
{

    /**
     * @var string
     */
    protected $className;


    /**
     * Constructor.
     * 
     * @param string $className
     * @param string $code
     * @param \Exception $previous
     */
    public function __construct($className, $code = null,\Exception $previous = null)
    {
        $this->setClassName($className);
        parent::__construct(sprintf("Undefined class '%s'", $className), $code, $previous);
    }


    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }


    /**
     * @param string $className
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }
}