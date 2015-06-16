<?php

namespace CloudCompli\SafeData;

use ArrayIterator;

class SafeData_Object extends SafeData_Base implements SafeData_Interface
{
    private $_data = array();
    
    public function __construct($data)
    {
        parent::__construct();
        foreach($data as $key => $value)
        {
            if(is_object($value) || is_array($value))
            {
                $this->_data[$key] = new SafeData_Object($value);
            }
            else
            {
                $this->_data[$key] = new SafeData_Value($value);
            }
        }
    }
    
    public function __setConfig($key, $value)
    {
        parent::__setConfig($key, $value);
        foreach(array_keys($this->_data) as $dataKey){
            $this->_data[$dataKey]->__setConfig($key, $value);
        }
    }
    
    public function __call($name, $arguments) 
    {
        if(is_int($name)){ // support for accessing array values
            return $this()[$name];
        }else{
            return parent::__call($name, $arguments);
        }
    }
    
    public function __get($key)
    {
        if(array_key_exists($key, $this->_data))
        {
            return $this->_data[$key];
        }
        else
        {
            return new SafeData_Null();
        }
    }
    
    public function __invoke()
    {
        return $this->__toArray();
    }
    
    public function __toRawString()
    {
        return json_encode($this());
    }
    
    public function __toArray()
    {
        $arr = array();
        foreach($this->_data as $key => $value)
        {
            $arr[$key] = $value();
        }
        return $arr;
    }
    
    public function exists()
    {
        return true;
    }
    
    public function getIterator()
    {
        return new ArrayIterator($this->_data);
    }
}