<?php
/* Global function Proxy for SuperStrCore */

use Konexia\SuperStr\SuperStrCore;

if (!function_exists('super_str')) {
    /**
     * A flexible and powerful string manipulation helper for PHP.
     *
     * @param string $value The string to manipulate
     *
     * @return mixed|Konexia\SuperStr\SuperStrCore
     */
    function super_str($value = '')
    {
        return new SuperStrCore($value);
    }
}
