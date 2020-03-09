<?php

function popl_get_view_path($path){
    $view_path = dirname($_SERVER["SCRIPT_FILENAME"]) . "/" . $path . ".php";
    
    if (popl_str_startsWith($path, "/")){
        $view_path = $_SERVER["DOCUMENT_ROOT"] . $path . ".php";
    }
    return $view_path;
}

function popl_view($path, $data=[]){   
    $view_path = popl_get_view_path($path);    

    ob_clean();
    extract($data);
    $GLOBALS["POPL_VIEW_FROM_POPL"] = true;
    ob_start();
    require($view_path);
    $POPL_VIEW_CONTENT = ob_get_clean();
    
    // layout render

    if (isset($POPL_VIEW_LAYOUT)){        
        ob_start();
        $popl_view_layout = popl_get_view_path($POPL_VIEW_LAYOUT);
        require($popl_view_layout);
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