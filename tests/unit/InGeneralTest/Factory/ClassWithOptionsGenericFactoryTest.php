<?php

namespace InGeneralTest\Factory;

use InGeneral\Factory\ClassWithOptionsGenericFactory;


class ClassWithOptionsGenericFactoryTest extends \PHPUnit_Framework_TestCase
{


    public function testCreateInstanceWithNonExistantClass()
    {
        $this->setExpectedException('InGeneral\Exception\UndefinedClassException', "Undefined class 'FooClass'");
        
        $className = 'FooClass';
        
        $factory = new ClassWithOptionsGenericFactory();
        $factory->createInstance($className);
    }


    public function testCreateInstance()
    {
        $className = 'InGeneral\Factory\ClassWithOptionsGenericFactory';
        
        $factory = new ClassWithOptionsGenericFactory();
        $instance = $factory->createInstance($className);
        
        $this->assertInstanceOf($className, $instance);
    }
}