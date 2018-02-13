<?php

/**
 * The Mutator Utility Class.
 *
 * This class intended for dynamic getter and setter for
 * the inheritor or sub class or whoever extends this class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 25, 2017
 */

namespace LordDashMe\MailChimp\Utilities;

class Mutator implements \ArrayAccess
{
    /**
     * The mutator bag field holds the key value pair.
     *
     * @var array
     */
    protected $mutatorBag = [];

    /**
     * The __set magic method of PHP.
     * Run when writing data to inaccessible properties.
     *
     * @param  string  $key
     * @param  mixed   $value
     *
     * @return void
     */
    public function __set($key, $value)
    {
        $this->mutatorBag[$key] = $value;
    }

    /**
     * The __get magic method of PHP.
     * Utilized for reading data from inaccessible properties.
     *
     * @param  string  $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        return $this->mutatorBag[$key];
    }

    /**
     * The __isset magic method of PHP.
     * Triggered by calling isset() or empty() on inaccessible properties.
     *
     * @param  string  $key
     *
     * @return boolean
     */
    public function __isset($key)
    {
        return isset($this->mutatorBag[$key]);
    }

    /**
     * The __unset magic method of PHP.
     * Invoked when unset() is used on inaccessible properties.
     *
     * @param  string  $key
     *
     * @return void
     */
    public function __unset($key)
    {
        unset($this->mutatorBag[$key]);
    }

    /**
     * The offsetSet method is the required method in the ArrayAccess interface.
     * Assign a value to the specified offset.
     *
     * @param  string  $key
     * @param  mixed   $value
     *
     * @return void
     */
    public function offsetSet($key, $value) 
    {
        $this->mutatorBag[$key] = $value;
    }
    
    /**
     * The offsetGet method is the required method in the ArrayAccess interface.
     * Offset to retrieve.
     *
     * @param  string  $key
     *
     * @return mixed
     */
    public function offsetGet($key) 
    {
        return $this->mutatorBag[$key];
    }

    /**
     * The offsetExists method is the required method in the ArrayAccess interface.
     * Whether an offset exists.
     *
     * @param  string  $key
     *
     * @return boolean
     */
    public function offsetExists($key) 
    {
        return isset($this->mutatorBag[$key]);
    }

    /**
     * The offsetUnset method is the required method in the ArrayAccess interface.
     * Unset an offset.
     *
     * @param  string  $key
     *
     * @return void
     */
    public function offsetUnset($key) 
    {
        unset($this->mutatorBag[$key]);
    }
}