<?php
function popl_param($arr, $param_name, $rules='', $default=false){    
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

function popl_param_get($param_name, $rules, $default=false){    
    return popl_param($_GET, $param_name, $rules, $default);
}

function popl_param_post($param_name, $rules, $default=false){
    return popl_param($_POST, $param_name, $rules, $default);
}

function popl_param_san_html_encode($arr, $param_name, $rules, $default){
    $input = popl_param($arr, $param_name, $rules);
    if ($input === false){
        return $default;
    }else{
        return popl_san_html_encode($input);
    }
}

function popl_param_get_san_html_encode($param_name, $rules, $default=false){
    return popl_param_san_html_encode($_GET, $param_name, $rules, $default);
}

function popl_param_post_san_html_encode($param_name, $rules, $default=false){
    return popl_param_san_html_encode($_POST, $param_name, $rules, $default);
}

function popl_param_san_html_remove($arr, $param_name, $rules, $default=false){
    $input = popl_param($arr, $param_name, $rules);
    if ($input === false){
        return $default;
    }else{
        return popl_san_html_remove($input);
    }
}

function popl_param_get_san_html_remove($param_name, $rules, $default=false){
    return popl_param_san_html_remove($_GET, $param_name, $rules, $default);
}

function popl_param_post_san_html_remove($param_name, $rules, $default=false){
    return popl_param_san_html_remove($_POST, $param_name, $rules, $default);
}

function popl_param_post_password_encrypt($param_name, $rules, $default=false){
    $param = popl_param_post_san_html_remove($param_name, $rules, false);
    if ($param === false){
        return $default;
    }

    return popl_password_encrypt($param);
}