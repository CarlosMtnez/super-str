<?php
/* Static Proxy for SuperStr */

namespace Konexia\SuperStr;

class Sstr
{
    public static function __callStatic($name, $arguments)
    {
        $instance = new SuperStr($arguments[0]);
        return $instance->$name(...array_slice($arguments, 1));
    }

    /**
     * Get an instance of SuperStr
     *
     * @param string $value The initial value for the string
     *
     * @return SuperStr
     */
    public static function getInstance(string $value): SuperStr
    {
        return new SuperStr($value);
    }
}