<?php

namespace InGeneralTest\Exception;

use InGeneral\Exception\UndefinedClassException;


class UndefinedClassExceptionTest extends \PHPUnit_Framework_TestCase
{


    public function testConstructor()
    {
        $className = 'FooClass';
        
        $e = new UndefinedClassException($className);
        
        $this->assertSame($className, $e->getClassName());
        $this->assertSame("Undefined class 'FooClass'", $e->getMessage());
    }
}