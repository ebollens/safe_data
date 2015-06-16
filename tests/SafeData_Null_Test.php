<?php

use CloudCompli\SafeData\SafeData_Null;

class SafeData_Null_Test extends PHPUnit_Framework_TestCase
{
    public function testInvoke()
    {
        $object = new SafeData_Null();
        $this->assertNull($object());
    }
    
    public function testExists()
    {
        $object = new SafeData_Null();
        $this->assertFalse($object->exists());
    }
    
    public function testGet()
    {
        $object = new SafeData_Null();
        $this->assertInstanceOf(SafeData_Null::class, $object->a);
        $this->assertNull($object->a());
    }
    
    public function testToString()
    {
        $object = new SafeData_Null();
        $this->assertEquals('', $object->__toString());
    }
    
    public function testToRawString()
    {
        $object = new SafeData_Null();
        $this->assertEquals('', $object->__toRawString());
    }
    
    public function testGetIterator()
    {
        $object = new SafeData_Null();
        $iterator = $object->getIterator();
        $this->assertInstanceOf(ArrayIterator::class, $iterator);
        $this->assertNull($iterator->current());
        $this->assertCount(0, $iterator);
    }
    
    public function testIsset()
    {
        $object = new SafeData_Null();
        $this->assertFalse(isset($object->a));
    }
    
    public function testSet()
    {
        $object = new SafeData_Null();
        $object->a = 'b';
        $this->assertFalse(isset($object->a));
    }
    
    public function testUnset()
    {
        $object = new SafeData_Null();
        unset($object->a);
        $this->assertFalse(isset($object->a));
    }
    
    public function testOffsetExists()
    {
        $object = new SafeData_Null();
        $this->assertFalse(isset($object['qu']));
    }
    
    public function testOffsetGet()
    {
        $object = new SafeData_Null();
        $this->assertNull($object['qu']);
    }
    
    public function testOffsetSet()
    {
        $object = new SafeData_Null();
        $object['a'] = 'b';
        $this->assertFalse(isset($object['a']));
    }
    
    public function testOffsetUnset()
    {
        $object = new SafeData_Null();
        unset($object['a']);
        $this->assertFalse(isset($object['a']));
    }
}