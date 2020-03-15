<?php

function popl_password_encrypt($input){
    return password_hash($input, PASSWORD_BCRYPT);
}

function popl_password_match($plain_input, $hash){
    return password_verify($plain_input, $hash);
}