<?php

/**
 * The Mutator Utility Class.
 * 
 * @author Joshua Clifford Reyes<reyesjoshuaclifford@gmail.com>
 * @since August 25, 2017
 */

namespace LordDashMe\MailChimp\Utilities;

class Mutator
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
}