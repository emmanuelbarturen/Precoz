<?php

/**
 * @param $value
 * @param string $prefix
 * @return string
 */
function formattedString($value, string $prefix = '#')
{
    return sprintf($prefix . "-%'.05d\n", $value);
}
