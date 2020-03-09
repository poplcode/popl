<?php

function popl_password_encrypt($input){
    return password_hash($input, PASSWORD_BCRYPT);
}