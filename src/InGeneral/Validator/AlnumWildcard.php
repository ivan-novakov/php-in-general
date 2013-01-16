<?php

namespace InGeneral\Validator;

use Zend\I18n\Validator\Alpha;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\AbstractValidator;


/**
 * Custom validator for validating search field values.
 * 
 * If a field does not contain wildcard, it is checked against the "Alnum" or "Alpha" (with the "noDigits" option)
 * validators. If there is a wildcard, the minimal string length is also checked (option "minWildcardLength", 
 * default is 5).
 *
 */
class AlnumWildcard extends AbstractValidator
{

    const CONTAINS_INVALID_CHARACTERS = 'containsInvalidCharacters';

    const WILDCARD_TOO_SHORT = 'wildcardTooShort';

    protected $messageTemplates = array(
        self::CONTAINS_INVALID_CHARACTERS => 'The value contains invalid characters', 
        self::WILDCARD_TOO_SHORT => 'The wildcard must contain at least %min% characters'
    );

    protected $messageVariables = array(
        'min' => array(
            'options' => 'minWildcardLength'
        )
    );

    protected $options = array(
        'noDigits' => false, 
        'minWildcardLength' => 5, 
        'wildcardCharacter' => '*'
    );


    /**
     * (non-PHPdoc)
     * @see \Zend\Validator\ValidatorInterface::isValid()
     */
    public function isValid ($value)
    {
        $this->setValue($value);
        
        if (strstr($value, $this->_getWildcardCharacter())) {
            return $this->_isValidWildcardValue($value);
        }
        
        return $this->_isValidSimpleValue($value);
    }


    /**
     * Checks a value without a wildcard.
     * 
     * @param string $value
     * @return boolean
     */
    protected function _isValidSimpleValue ($value)
    {
        if ($this->getOption('noDigits')) {
            $validator = new Alpha();
        } else {
            $validator = new Alnum();
        }
        
        if (! $validator->isValid($value)) {
            $this->error(self::CONTAINS_INVALID_CHARACTERS);
            return false;
        }
        
        return true;
    }


    /**
     * Checks a value with a wildcard.
     * 
     * @param string $value
     * @return boolean
     */
    protected function _isValidWildcardValue ($value)
    {
        $simpleValue = str_replace($this->_getWildcardCharacter(), '', $value);
        if (strlen($simpleValue) < $this->getOption('minWildcardLength')) {
            $this->error(self::WILDCARD_TOO_SHORT);
            return false;
        }
        
        return $this->_isValidSimpleValue($simpleValue);
    }


    /**
     * Returns the wildcard character.
     * 
     * @return string
     */
    protected function _getWildcardCharacter ()
    {
        return $this->getOption('wildcardCharacter');
    }
}