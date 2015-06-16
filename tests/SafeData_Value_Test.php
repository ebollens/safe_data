<?php

use CloudCompli\SafeData\SafeData_Value;
use CloudCompli\SafeData\SafeData_Null;

class SafeData_Value_Test extends PHPUnit_Framework_TestCase
{
    public function testInvoke()
    {
        $object = new SafeData_Value('a');
        $this->assertEquals('a', $object());
    }
    
    public function testToString()
    {
        $object = new SafeData_Value(1);
        $this->assertEquals('1', $object->__toString());
        $object = new SafeData_Value('<a>');
        $this->assertEquals('&lt;a&gt;', $object->__toString());
    }
    
    public function testToRawString()
    {
        $object = new SafeData_Value(1);
        $this->assertEquals('1', $object->__toRawString());
        $object = new SafeData_Value('<a>');
        $this->assertEquals('<a>', $object->__toRawString());
    }
    
    public function testGet()
    {
        $object = new SafeData_Value(1);
        $this->assertInstanceOf(SafeData_Null::class, $object->a);
    }
    
    public function testCall()
    {
        $object = new SafeData_Value(1);
        $this->assertNull($object->a());
    }
    
    public function testGetIterator()
    {
        $object = new SafeData_Value(1);
        $iterator = $object->getIterator();
        $this->assertInstanceOf(ArrayIterator::class, $iterator);
        $this->assertEquals(1, $iterator->current());
        $this->assertCount(1, $iterator);
    }
    
    public function testIsset()
    {
        $object = new SafeData_Value(1);
        $this->assertFalse(isset($object->a));
    }
    
    public function testSet()
    {
        $object = new SafeData_Value(1);
        $object->a = 'b';
        $this->assertFalse(isset($object->a));
    }
    
    public function testUnset()
    {
        $object = new SafeData_Value(1);
        unset($object->a);
        $this->assertFalse(isset($object->a));
    }
    
    public function testOffsetExists()
    {
        $object = new SafeData_Value(1);
        $this->assertFalse(isset($object['qu']));
    }
    
    public function testOffsetGet()
    {
        $object = new SafeData_Value(1);
        $this->assertNull($object['qu']);
    }
    
    public function testOffsetSet()
    {
        $object = new SafeData_Value(1);
        $object['a'] = 'b';
        $this->assertFalse(isset($object['a']));
    }
    
    public function testOffsetUnset()
    {
        $object = new SafeData_Value(1);
        unset($object['a']);
        $this->assertFalse(isset($object['a']));
    }
}