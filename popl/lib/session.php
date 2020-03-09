<?php
function popl_session_start(){
    if (isset($_SESSION) == false){
        session_start();
    }
}

function popl_session_set($key, $val){
    popl_session_start();
    $_SESSION[$key] = $val;
}

function popl_session_get($key, $default=null){
    popl_session_start();
    if (isset($_SESSION[$key])){
        return $_SESSION[$key];
    }
    return $default;
}

function popl_session_remove($key){
    popl_session_start();
    if (isset($_SESSION[$key])){
        unset($_SESSION[$key]);
    }
}