<?php
// 파라미터 포함 주소
function popl_requset_uri(){
    return $_SERVER["REQUEST_URI"];
}

// 파라미터 제거한 파일 경로. ex. www.mydomian.com
function popl_request_host(){
    return parse_url(popl_requset_uri(),PHP_URL_HOST);    
}

// //myurl.html
function popl_request_path(){
    return parse_url(popl_requset_uri(),PHP_URL_PATH);    
}

// ?a=1&b=2
function popl_request_query(){
    return parse_url(popl_requset_uri(),PHP_URL_QUERY);
}

