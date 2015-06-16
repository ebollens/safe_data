<?php

namespace CloudCompli\SafeData;

use ArrayAccess;
use IteratorAggregate;

interface SafeData_Interface extends ArrayAccess, IteratorAggregate
{
    /**
     * Returns the value wrapped by the SafeData_Interface object.
     * 
     * @return mixed
     */
    public function __invoke();
    
    /**
     * Returns a string representation of the value wrapped by the
     * SafeData_Interface object.
     * 
     * @return string
     */
    public function __toRawString();
    
    /**
     * Returns a string representation of the value wrapped by the
     * SafeData_Interface object, with escaping unless disabled.
     * 
     * To get the unescaped value, call:
     * 
     *      ->__toRawString();
     * 
     * To disable escaping altogether for this object, call:
     * 
     *      ->_('serialize', false)
     * 
     * This may be called on a parent or the object itself.
     * 
     * @return string
     */
    public function __toString();
    
    /**
     * Returns true if the object exists. A SafeData_Null object will return 
     * false, while all others will return true.
     * 
     * @return boolean
     */
    public function exists();
    
    /**
     * Returns the SafeData_Interface object stored as a sub-object of this
     * object by the name $key.
     * 
     * @param string $key
     * @return SafeData_Interface
     */
    public function __get($key);
    
    /**
     * Returns the value of the SafeData_Interface object stored as a 
     * sub-object of this object by the name $key.
     * 
     * This ensures that these two behaviors are equivalent:
     * 
     *      (1) $sub = $obj->sub;
     *          $sub();
     * 
     *      (2) $obj->sub();
     * 
     * This method provides the latter, while __get($key) and __invoke() on the
     * child object provides the former.
     * 
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments);
    
    /**
     * Returns true if the sub-object exists.
     * 
     * This ensures that these two behaviors are equivalent:
     * 
     *      (1) $obj->sub->exists()
     * 
     *      (2) isset($obj->sub)
     * 
     * This method provider the latter, while exists() on the child object
     * provides the former.
     * 
     * @param type $key
     * @return true
     */
    public function __isset($key);
    
}