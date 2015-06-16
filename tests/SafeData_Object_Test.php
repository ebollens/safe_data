<?php

use CloudCompli\SafeData\SafeData_Object;
use CloudCompli\SafeData\SafeData_Value;
use CloudCompli\SafeData\SafeData_Null;

class SafeData_Object_Test extends PHPUnit_Framework_TestCase
{
    public function testToArray()
    {
        $object = new SafeData_Object(['foo'=>'bar', 'qu'=>'ux']);
        $this->assertTrue(method_exists($object, '__toArray'));
        $array = $object->__toArray();
        $this->assertTrue(array_key_exists('foo', $array));
        $this->assertEquals('bar', $array['foo']);
        $this->assertTrue(array_key_exists('qu', $array));
        $this->assertEquals('ux', $array['qu']);
    }
    
    public function testConstructor()
    {
        $object = new SafeData_Object(['arr'=>[], 'val'=>1]);
        $this->assertInstanceOf(SafeData_Object::class, $object->arr);
        $this->assertInstanceOf(SafeData_Value::class, $object->val);
    }
    
    public function testConstructorFromObject()
    {
        $source = new stdClass;
        $source->arr = [];
        $source->val = 1;
        $object = new SafeData_Object($source);
        $this->assertInstanceOf(SafeData_Object::class, $object->arr);
        $this->assertInstanceOf(SafeData_Value::class, $object->val);
    }
    
    public function testCall()
    {
        $object = new SafeData_Object(['foo' => 'bar', 'arr' => ['qu' => 'ux']]);
        $this->assertEquals('bar', $object->foo());
        $this->assertTrue(is_array($object->arr()));
        $this->assertEquals('ux', $object->arr()['qu']);
    }
    
    public function testNonExistentValue()
    {
        $object = new SafeData_Object(['']);
        $this->assertInstanceOf(SafeData_Null::class, $object->foo);
        $this->assertInstanceOf(SafeData_Null::class, $object->foo->bar);
        $this->assertNull($object->foo->bar());
    }
    
    public function testInvoke()
    {
        $object = new SafeData_Object(['foo'=>'bar']);
        $array = $object();
        $this->assertTrue(is_array($array));
        $this->assertEquals('bar', $array['foo']);
    }
    
    public function testToString()
    {
        $object = new SafeData_Object(['foo'=>'<bar>']);
        $this->assertEquals('{&quot;foo&quot;:&quot;&lt;bar&gt;&quot;}', $object->__toString());
    }
    
    public function testToRawString()
    {
        $object = new SafeData_Object(['foo'=>'<bar>']);
        $this->assertEquals('{"foo":"<bar>"}', $object->__toRawString());
    }
    
    public function testExists()
    {
        $object = new SafeData_Object([]);
        $this->assertTrue($object->exists());
    }
    
    public function testGetIterator()
    {
        $object = new SafeData_Object(['foo'=>'bar','qu'=>'ux']);
        $iterator = $object->getIterator();
        $this->assertInstanceOf(ArrayIterator::class, $iterator);
        $this->assertEquals('bar', $iterator->current());
        $this->assertCount(2, $iterator);
    }
    
    public function testIsset()
    {
        $object = new SafeData_Object(['foo'=>'bar']);
        $this->assertTrue(isset($object->foo));
        $this->assertFalse(isset($object->qu));
    }
    
    public function testSet()
    {
        $object = new SafeData_Object([]);
        $object->a = 'b';
        $this->assertFalse(isset($object->a));
    }
    
    public function testUnset()
    {
        $object = new SafeData_Object([]);
        unset($object->a);
        $this->assertFalse(isset($object->a));
    }
    
    public function testOffsetExists()
    {
        $object = new SafeData_Object(['foo'=>'bar']);
        $this->assertTrue(isset($object['foo']));
        $this->assertFalse(isset($object['qu']));
    }
    
    public function testOffsetGet()
    {
        $object = new SafeData_Object(['foo'=>'bar']);
        $this->assertEquals('bar', $object['foo']);
        $this->assertNull($object['qu']);
    }
    
    public function testOffsetSet()
    {
        $object = new SafeData_Object([]);
        $object['a'] = 'b';
        $this->assertFalse(isset($object['a']));
    }
    
    public function testOffsetUnset()
    {
        $object = new SafeData_Object([]);
        unset($object['a']);
        $this->assertFalse(isset($object['a']));
    }
    
    public function testConfig()
    {
        $object = new SafeData_Object(['foo'=>'<bar>']);
        $this->assertEquals('{&quot;foo&quot;:&quot;&lt;bar&gt;&quot;}', $object->__toString());
        $object = new SafeData_Object(['foo'=>'<bar>']);
        $object->_('escape', false);
        $this->assertEquals('{"foo":"<bar>"}', $object->__toString());
    }
    
    public function testConfigPropagation()
    {
        $object = new SafeData_Object(['qu'=>['foo'=>'<bar>']]);
        $this->assertEquals('{&quot;foo&quot;:&quot;&lt;bar&gt;&quot;}', $object->qu->__toString());
        $object = new SafeData_Object(['qu'=>['foo'=>'<bar>']]);
        $object->_('escape', false);
        $this->assertEquals('{"foo":"<bar>"}', $object->qu->__toString());
    }
}