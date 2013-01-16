<?php

namespace InGeneralTest\Validator;

use InGeneral\Validator\AlnumWildcard;


class AlnumWildcardTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var AlnumWildcard
     */
    protected $_validator = null;


    public function setUp ()
    {
        $this->_validator = new AlnumWildcard();
    }


    public function testIsValidWithAlternativeWildcardCharacter ()
    {
        $this->_validator->setOptions(array(
            'wildcardCharacter' => '%'
        ));
        $this->assertTrue($this->_validator->isValid('abc123%'));
    }


    /**
     * @dataProvider dataForTestIsValid
     * @param array $input
     */
    public function testIsValid ($value, $expectError = null, $options = null)
    {
        if (is_array($options)) {
            $this->_validator->setOptions($options);
        }
        
        if (isset($expectError)) {
            $this->assertFalse($this->_validator->isValid($value));
            $this->assertArrayHasKey($expectError, $this->_validator->getMessages());
        } else {
            $this->assertTrue($this->_validator->isValid($value));
        }
    }


    public function dataForTestIsValid ()
    {
        return array(
            array(
                'value' => 'abcdef123', 
                'expectError' => null, 
                'options' => null
            ), 
            array(
                'value' => 'abcdef123', 
                'expectError' => AlnumWildcard::CONTAINS_INVALID_CHARACTERS, 
                'options' => array(
                    'noDigits' => true
                )
            ), 
            array(
                'value' => 'abcdef#', 
                'expectError' => AlnumWildcard::CONTAINS_INVALID_CHARACTERS, 
                'options' => null
            ), 
            array(
                'value' => 'abc123*', 
                'expectError' => null, 
                'options' => null
            ), 
            array(
                'value' => 'abc123*', 
                'expectError' => AlnumWildcard::CONTAINS_INVALID_CHARACTERS, 
                'options' => array(
                    'noDigits' => true
                )
            ), 
            array(
                'value' => 'ab*', 
                'expectError' => AlnumWildcard::WILDCARD_TOO_SHORT, 
                'options' => null
            ), 
            array(
                'value' => 'abc#*', 
                'expectError' => AlnumWildcard::CONTAINS_INVALID_CHARACTERS, 
                'options' => array(
                    'minWildcardLength' => 3
                )
            )
        )
        ;
    }


    protected function _formatCaseError ($caseNum, $message)
    {
        return sprintf("Case #%d: %s", $caseNum, $message);
    }
}