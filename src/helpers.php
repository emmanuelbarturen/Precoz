<?php


function formattedString($value, string $prefix = '#')
{
    return sprintf($prefix . "-%'.05d\n", $value);
}
