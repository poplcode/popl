<?php
function popl_str_startsWith($input, $value) {    
    return $value === "" || strrpos($input, $value, -strlen($input)) !== false;
}

function popl_str_endsWith($input, $value) {    
    return $value === "" || (($temp = strlen($input) - strlen($value)) >= 0 && strpos($input, $value, $temp) !== false);
}

function popl_str_contains($input, $value)
{
    return strpos($value, $input) !== false;
}

function popl_str_trim($input){
    return preg_replace("/(^\s+)|(\s+$)/us", "", $input);    
}

function popl_str_split($input, $seperater){
    return explode($seperater, $input);
}

function popl_str_replace($input, $old_str, $new_str){
    return str_replace($old_str, $new_str, $input);
}