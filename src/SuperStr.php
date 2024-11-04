<?php
/* Static Proxy for SuperStrCore */

namespace Konexia\SuperStr;

class SuperStr
{
    public static function __callStatic($name, $arguments)
    {
        $instance = new SuperStrCore($arguments[0]);
        return $instance->$name(...array_slice($arguments, 1));
    }

    /**
     * Get an instance of SuperStrCore
     *
     * @param string $value The initial value for the string
     *
     * @return SuperStrCore
     */
    public static function getInstance(string $value): SuperStrCore
    {
        return new SuperStrCore($value);
    }
}