<?php
function popl_array_has_key($arr, $key){
    return array_key_exists($key, $arr);
}

function popl_array_map($arr, $func){
    return array_map($func, $arr);
}

function popl_array_join($arr, $glue=''){
    return implode($glue, $arr);
}

function popl_array_map_join($arr, $func, $glue=''){
    return popl_array_join(popl_array_map($arr, $func), $glue);
}