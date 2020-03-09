<?php
function popl_view_layout($layout_path=null){
    // direct 접근 체크
    if (isset($GLOBALS["POPL_VIEW_FROM_POPL"]) === false){
        popl_view_404();
        exit();
    }

    // 레이아웃을 안 쓸 경우
    if ($layout_path == null){
        return;
    }else{ // 직접 쓸 경우
        $GLOBALS["POPL_VIEW_LAYOUT"] = $layout_path;
    }
}

function popl_view($path, $data=[]){
    ob_clean();
    extract($data);
    $GLOBALS["POPL_VIEW_FROM_POPL"] = true;
    ob_start();
    require($_SERVER["DOCUMENT_ROOT"] . $path . ".php");
    $POPL_VIEW_CONTENT = ob_get_clean();
    
    // layout render

    if (isset($GLOBALS["POPL_VIEW_LAYOUT"])){
        $popl_view_layout = $GLOBALS["POPL_VIEW_LAYOUT"];
        ob_start();
        require($_SERVER["DOCUMENT_ROOT"] . $popl_view_layout . ".php");
        $output = ob_get_clean();
        echo $output;        
    }else{
        echo $POPL_VIEW_CONTENT;        
    }
}

function popl_view_object($path, $data=[]){
    $new_vals = [];
    foreach($data as $key=>$val){
        if (is_array($val)){
            $new_vals[$key] = (object) $val;
        }else{
            $new_vals[$key] = $val;
        }
    }

    return popl_view($path, $new_vals);
}

function popl_view_404($path="/views/404", $data=[]){
    popl_view($path,$data);
    exit();
}