<?php

if(!function_exists('replace_variables'))
{
    /**
     * Replace variables in a string with their values
     * 
     * The string to look for variables in
     * @param string $string
     * 
     * An associative array of variables to replace
     * @param array $replaces
     * 
     * @return string
     */
    function replace_variables($string, $replaces = [])
    {
        $callback = function ($match) use ($replaces) {
            $variable = trim($match[0], '{}');

            if(array_key_exists($variable, $replaces))
            {
                return $replaces[$variable];
            }

            return $match[0];
        };

        return preg_replace_callback('/{.*?}/', $callback, $string);
    }
}

