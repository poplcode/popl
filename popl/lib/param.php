<?php
function popl_param($arr, $param_name, $rules='', $default=False){    
    if (isset($arr[$param_name]) === false){        
        return $default;
    }
    

    $val = $arr[$param_name];
    $rule_arr = popl_str_split($rules, ",");
    
    $is_valid = popl_valid_check_match_rules($val, $rule_arr);

    if ($is_valid){
        return $val;
    }else{
        return $default;
    }
    
}

function popl_param_get($param_name, $rules, $default=False){    
    return popl_param($_GET, $param_name, $rules, $default);
}

function popl_param_post($param_name, $rules, $default=False){
    return popl_param($_POST, $param_name, $rules, $default);
}