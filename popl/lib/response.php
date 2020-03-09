<?php
function popl_response_redirect($url='/', $http_status_code='301'){
    header("Location: $url", true, $http_status_code);
    exit();
}