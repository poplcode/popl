<?php
function popl_response_redirect($url='/', $http_status_code='301'){
    header("Location: $url", true, $http_status_code);
    exit();
}

function popl_response_redirect_flash($url='/', $message='', $http_status_code='301'){
    popl_flash_set($message);
    popl_response_redirect($url, $http_status_code);
}