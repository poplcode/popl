<?php
function popl_san_email($input){
    return filter_var($input, FILTER_SANITIZE_EMAIL);
}

function popl_san_html_encode($input){
    return htmlspecialchars($input);
}

function popl_san_html_decode($input){
    return htmlspecialchars_decode($input);
}

function popl_san_html_remove($input){
    return strip_tags($input);
}