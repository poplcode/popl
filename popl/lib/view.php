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

function popl_view_layout_direct_start(){
    ob_clean();
    ob_start();
}

function popl_view_layout_direct_end($POPL_VIEW_LAYOUT, $data=[]){
    extract($data);
    $POPL_VIEW_CONTENT = ob_get_clean();
    $popl_view_layout = popl_get_view_path($POPL_VIEW_LAYOUT);
    require($popl_view_layout);
    $output = ob_get_clean();
    echo $output;        
}

function popl_view_404($path="/views/404", $data=[]){
    popl_view($path,$data);
    exit();
}