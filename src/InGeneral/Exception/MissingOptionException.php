<?php

namespace InGeneral\Exception;


/**
 * Exception thrown in objects, where a configuration option is missing.
 */
class MissingOptionException extends \RuntimeException
{

    /**
     * The missing configuration option name.
     * 
     * @var string
     */
    protected $optionName = '';


    /**
     * Constructor.
     * 
     * @param string $optionName
     */
    public function __construct($optionName)
    {
        $this->optionName = $optionName;
        parent::__construct(sprintf("Missing option '%s'", $optionName));
    }


    /**
     * Returns the missing configuration option name.
     * 
     * @return string
     */
    public function getMissingOptionName()
    {
        return $optionName;
    }
}