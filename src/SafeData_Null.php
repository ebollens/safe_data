<?php

namespace CloudCompli\SafeData;

use ArrayIterator;

class SafeData_Null extends SafeData_Base implements SafeData_Interface
{
    public function __invoke()
    {
        return null;
    }
    
    public function __get($key)
    {
        return new SafeData_Null();
    }
    
    public function __toRawString()
    {
        return '';
    }
    
    public function exists()
    {
        return false;
    }
    
    public function getIterator()
    {
        return new ArrayIterator([]);
    }
}