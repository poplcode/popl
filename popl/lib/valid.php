<?php
function popl_valid_http_method_get(){        
    return $_SERVER["REQUEST_METHOD"] === "GET";
}

function popl_valid_http_method_post(){    
    return $_SERVER["REQUEST_METHOD"] == "POST";
}

function popl_valid_http_method_get_404(){        
    if (popl_valid_http_method_get() === false){
        popl_view_404();
        exit();
    }
}

function popl_valid_http_method_post_404(){        
    if (popl_valid_http_method_post() === false){
        popl_view_404();
        exit();
    }
}

// r
function popl_valid_required($input){    
    return is_array($input) ? empty($input) === False : popl_str_trim($input) !== '';
}

// n
function popl_valid_number($input){
    return (bool) preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $input);
}

// min:1
function popl_valid_number_min($input, $min){    
    if (popl_valid_number($input) === false){
        return false;
    }    
    
    if (popl_valid_number($min) === false){
        return false;
    }   

    return $input >= $min;
}


// max:10
function popl_valid_number_max($input, $min){    
    if (popl_valid_number($input) === false){
        return false;
    }    
    
    if (popl_valid_number($min) === false){
        return false;
    }   

    return $input <= $min;
}

// minlen:1
function popl_valid_str_min_len($input, $len){
    if (popl_valid_number($len) === false){
        return false;
    }
    
    return ($len <= mb_strlen($input));
}

// maxlen:1
function popl_valid_str_max_len($input, $len){
    if (popl_valid_number($len) === false){
        return false;
    }
    
    return ($len >= mb_strlen($input));
}

// an
function popl_valid_str_alpha_numeric($str)
{
    return ctype_alnum((string) $str);
}

// ans
function popl_valid_str_alpha_numeric_spaces($str)
{
    return (bool) preg_match('/^[A-Z0-9 ]+$/i', $str);
}

// and
function popl_valid_str_alpha_numeric_dash($str)
{
    return (bool) preg_match('/^[a-z0-9_-]+$/i', $str);
}

// anu
function popl_valid_str_alpha_numeric_underscore($str)
{
    return (bool) preg_match('/^[a-z0-9_]+$/i', $str);
}

function popl_valid_check_match_rules($val, $rule_arr){
    $is_valid = true;
    foreach($rule_arr as $rule){
        if ($rule === "r" && popl_valid_required($val) === false){
            $is_valid = false;
            
            break;
        }

        if ($rule === "n" && popl_valid_number($val) === false){
            $is_valid = false;            
            break;
        }

        if (popl_str_startsWith($rule, "min:")){
            $len = popl_str_replace($rule, "min:", '');
            if (popl_valid_number_min($val, $len) === false){
                $is_valid = false;                
                break;
            }
        }

        if (popl_str_startsWith($rule, "max:")){
            $len = popl_str_replace($rule, "max:", '');
            if (popl_valid_number_max($val, $len) === false){
                $is_valid = false;                
                break;
            }
        }

        if (popl_str_startsWith($rule, "minlen:")){
            $len = popl_str_replace($rule, "minlen:", '');
            if (popl_valid_str_min_len($val, $len) === false){
                $is_valid = false;                
                break;
            }
        }

        if (popl_str_startsWith($rule, "maxlen:")){
            $len = popl_str_replace($rule, "maxlen:", '');
            if (popl_valid_str_max_len($val, $len) === false){
                $is_valid = false;                
                break;
            }
        }

        if ($rule === "an" && popl_valid_str_alpha_numeric($val) === false){
            $is_valid = false;            
            break;
        }

        if ($rule === "ans" && popl_valid_str_alpha_numeric_spaces($val) === false){
            $is_valid = false;            
            break;
        }

        if ($rule === "and" && popl_valid_str_alpha_numeric_dash($val) === false){
            $is_valid = false;            
            break;
        }

        if ($rule === "anu" && popl_valid_str_alpha_numeric_underscore($val) === false){
            $is_valid = false;            
            break;
        }
    }
    
    return $is_valid;
}