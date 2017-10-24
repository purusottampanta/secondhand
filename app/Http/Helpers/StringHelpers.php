<?php

function str_before($str, $needle)
{
    $pos = strpos($str, $needle);

    return ($pos !== false) ? substr($str, 0, $pos) : $str;
}

// function str_after($str, $needle)
// {
//     return substr($str, (strrpos($str, $needle) ?: -1) + 1);
// }

function str_space($subject)
{
    return str_replace('_', ' ', $subject);
}
