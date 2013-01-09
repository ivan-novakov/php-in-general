<?php

namespace InGeneralTest\Util;

use InGeneral\Util\Options;


class OptionsTest extends \PHPUnit_Framework_TestCase
{


    public function testConstructorWithArray()
    {
        $options = new Options(array(
            'foo' => 'bar'
        ));
        
        $this->assertEquals('bar', $options->get('foo'));
    }


    public function testConstructorWithConfig()
    {
        $options = new Options(new \Zend\Config\Config(array(
            'foo' => 'bar'
        )));
        
        $this->assertEquals('bar', $options->get('foo'));
    }


    public function testConstructorWithDefaultOptions()
    {
        $options = array(
            'attr1' => 'value1', 
            'attr2' => 'value2'
        );
        
        $defaultOptions = array(
            'attr1' => 'value12', 
            'attr3' => 'value13'
        );
        
        $options = new Options($options, $defaultOptions);
        
        $this->assertEquals('value1', $options->get('attr1'));
        $this->assertEquals('value2', $options->get('attr2'));
        $this->assertEquals('value13', $options->get('attr3'));
    }


    public function testInvalidArgumentException()
    {
        $this->setExpectedException('\Zend\Stdlib\Exception\InvalidArgumentException');
        
        $options = new Options('test');
    }


    public function testSetter()
    {
        $options = new Options();
        $options->set('foo', 'bar');
        
        $this->assertEquals('bar', $options->get('foo'));
    }
}