<?php

namespace CloudCompli\SafeData;

use ArrayIterator;

class SafeData_Value extends SafeData_Base implements SafeData_Interface
{
    private $_data;
    
    public function __construct($value)
    {
        parent::__construct();
        $this->_data = $value;
    }
    
    public function __invoke()
    {
        return $this->_data;
    }
    
    public function __toRawString()
    {
        return (string)$this->_data;
    }
    
    public function __get($key)
    {
        return new SafeData_Null();
    }
    
    public function exists()
    {
        return true;
    }
    
    public function getIterator()
    {
        return new ArrayIterator([$this->_data]);
    }
}