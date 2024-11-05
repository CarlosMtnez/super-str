<?php
/* Global function Proxy for SuperStr */

use Konexia\SuperStr\SuperStr;

if (!function_exists('super_str')) {
    /**
     * A flexible and powerful string manipulation helper for PHP.
     *
     * @param string $value The string to manipulate
     *
     * @return mixed|Konexia\SuperStr\SuperStr
     */
    function super_str($value = '')
    {
        return new SuperStr($value);
    }
}

if (!function_exists('sstr')) {
    /**
     * A flexible and powerful string manipulation helper for PHP.
     *
     * @param string $value The string to manipulate
     *
     * @return mixed|Konexia\SuperStr\SuperStr
     */
    function super_str($value = '')
    {
        return new SuperStr($value);
    }
}
