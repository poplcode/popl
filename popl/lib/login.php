<?php
const POPL_LOGIN_KEY = "MEMBER_ID";

function popl_login_login($login_key){
    popl_session_set(POPL_LOGIN_KEY, $login_key);
}

function popl_login_is_login(){
    return popl_session_get(POPL_LOGIN_KEY) != null;    
}

function popl_login_logout(){
    popl_session_remove(POPL_LOGIN_KEY);
}

function popl_login_login_key(){
    return popl_session_get(POPL_LOGIN_KEY);    
}