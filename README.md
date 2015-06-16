# SafeData

Ever find yourself writing statements like this:

```php
if(array_key_exists('foo', $arr) 
    && is_array($arr['foo']) 
    && array_key_exists('bar', $arr['foo'])){
  echo $arr['foo']['bar'];
}
```

If so, then this simple little library may be for you.

SafeData provides immutable access to an object without the risk of hitting pesky "Undefined index: foo" and "Undefined property: stdClass::$foo" errors. To do this, it wraps objects, arrays and values in such a way that you can traverse into an object's properties, and properties of those properties, without any fear of hitting undefined indices or properties along the way.

It takes the code snippet above and makes it possible to simply write:

```php
echo $object->foo->bar;
```

It makes this possible by generating `SafeData_Object` instances from objects you traverse into, as well as `SafeData_Value` instances for leaf nodes and `SafeData_Null` instances when you hit non-existent keys. The only catch is that, when you're doing equality checks, you need to "de-reference" it out of the `SafeData_*` instance back into it's original type either by accessing the outer-most value as an array index or with a pair of `()`.

As an example:

```php
$object = new SafeData_Object(['foo'=>'bar', 'sub'=>['qu'=>'ux']]);

// accessing an existent property
$this->assertTrue($object->foo() == 'bar');
$this->assertTrue($object['foo'] == 'bar');
echo $object->foo; // prints "bar"

// accessing a non-existent property
$this->assertFalse($object->baz());
echo $object->baz; // prints ""

// accessing an existent property of a property
$this->assertTrue($object->sub->qu() == 'ux');
$this->assertTrue($object->sub['qu'] == 'ux');
echo $object->sub->qu; // prints "ux"

// accessing a non-existent property of a property
$this->assertFalse($object->sub->baz());
echo $object->sub->baz; // prints ""

// you can even access sub-properties of scalars without error
$this->assertFalse($object->foo->baz());
echo $object->foo->baz; // prints ""
```

## Contributions

[CloudCompli](http://cloudcompli.com) supports open source software as a [core part of its mission](http://cloudcompli.github.io). We use this software within our stack, and we've made it open source in the hopes that it will be useful to others. If you'd like to help make it better, we'd greatly appreciate your contribution.

Please see our [Contributing](http://cloudcompli.github.io/contributing) page to learn more.

## License

Copyright 2015 CloudCompli, Inc.

Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at

> http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
