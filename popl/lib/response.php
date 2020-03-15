<?php
function popl_response_redirect($url='/', $http_status_code='301'){
    header("Location: $url", true, $http_status_code);
    exit();
}

function popl_response_redirect_flash($url='/', $message='', $http_status_code='301'){
    popl_flash_set($message);
    popl_response_redirect($url, $http_status_code);
}

function popl_response_redirect_post($url='/', $params=[]){
    $input_tags = '';
    foreach($params as $key=>$val){
        $input_tags .= "<input type='hidden' name='$key' value='$val' />" . PHP_EOL;
    }
    $html = <<<CDATA
    <html><head></head><body>
    <form method='post' id='frm' name='frm' action='$url'>    
    $input_tags
    </form>
    <script type="text/javascript">
        document.getElementById('frm').submit();
    </script>
    </body></html>
CDATA;
    echo $html;
    exit();

}

function popl_response_redirect_post_flash($url='/', $params=[], $message=''){
    popl_flash_set($message);
    popl_response_redirect_post($url, $params);
}