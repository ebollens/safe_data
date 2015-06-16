<?php

namespace CloudCompli\SafeData;

abstract class SafeData_Base
{
    private $_config;
    
    public function __construct()
    {
        $this->_config = array(
            'escape' => true
        );
    }
    
    public function __toString()
    {
        if($this->_config['escape'])
            return htmlentities($this->__toRawString(), ENT_QUOTES, 'UTF-8', false);
        else
            return $this->__toRawString();
    }
    
    public function __call($name, $arguments) 
    {
        if($name == '_'){
            $this->__setConfig($arguments[0], $arguments[1]);
            return $this;
        }else{
            $obj = $this->$name;
            return $obj();
        }
    }
    
    protected function __setConfig($key, $value)
    {
        $this->_config[$key] = $value;
    }
    
    public function __isset($key)
    {
        return $this->$key->exists();
    }
    
    public function __set($key, $value)
    {
        // Nothing... this is immutable
    }
    
    public function __unset($key)
    {
        // Nothing... this is immutable
    }
    
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }
    
    public function offsetGet($offset)
    {
        return $this->__call($offset, array());
    }
    
    public function offsetSet($offset, $value)
    {
        // Nothing... this is immutable
    }
    
    public function offsetUnset($offset)
    {
        // Nothing... this is immutable
    }
}