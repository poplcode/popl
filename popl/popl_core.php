<?php
function popl_core_lib_import(){
    $libpath = dirname(__FILE__) . "/lib";
    $dirs = scandir($libpath);
    foreach($dirs as $dir){
        if ($dir == "." || $dir == ".."){
            continue;
        }
        $inc_path = $libpath . "/" . $dir;
        require_once($inc_path);
    }
}

const POPL_IS_START = true;
popl_core_lib_import();