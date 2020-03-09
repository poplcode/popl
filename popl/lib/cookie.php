<?php
function popl_cookie_set($key, $val){    
    setcookie($key, $val);
    $_COOKIE[$key] = $val;
}

function popl_cookie_get($key, $default=null){
    if (isset($_COOKIE[$key])){
        return $_COOKIE[$key];
    }else{
        return $default;
    }
}

function popl_cookie_remove($key){
    if (isset($_COOKIE[$key])){    
        unset($_COOKIE[$key]);
        setcookie($key, null, -1);
    }
}

function popl_cookie_set_array($key, $val){  
    $pre_cookie = popl_cookie_get_array($key, []);
    array_push($pre_cookie, $val);
    $str_cookie_val = serialize($pre_cookie);
    popl_cookie_set($key, $str_cookie_val);
}

function popl_cookie_get_array($key, $default=[]){
    if (isset($_COOKIE[$key])){
        $pre_cookie = $_COOKIE[$key];        
        $pre_cookie = unserialize($pre_cookie);
        return $pre_cookie;
    }else{
        return $default;
    }
}