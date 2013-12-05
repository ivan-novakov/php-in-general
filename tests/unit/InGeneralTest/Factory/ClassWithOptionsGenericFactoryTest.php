<?php

namespace InGeneralTest\Factory;

use InGeneral\Factory\ClassWithOptionsGenericFactory;


class FactoryImplementation extends ClassWithOptionsGenericFactory
{


    public function createObject($className, array $options = array())
    {
        return $this->createInstance($className, $options);
    }
}


class ClassWithOptionsGenericFactoryTest extends \PHPUnit_Framework_TestCase
{


    public function testCreateInstanceWithNonExistantClass()
    {
        $this->setExpectedException('InGeneral\Exception\UndefinedClassException', "Undefined class 'FooClass'");
        
        $className = 'FooClass';
        
        $factory = new FactoryImplementation();
        $factory->createObject($className);
    }


    public function testCreateInstance()
    {
        $className = 'InGeneralTest\Factory\FactoryImplementation';
        
        $factory = new FactoryImplementation();
        $instance = $factory->createObject($className);
        
        $this->assertInstanceOf($className, $instance);
    }
}