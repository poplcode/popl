<?php
function popl_import_config($varname){
    require(dirname(__FILE__) . "/../config/config.php");    
    $config_file_name = "config.$popl_env_config.php";
    require(dirname(__FILE__) . "/../config/" . $config_file_name);
    $varname = $varname . "_config";    
    $ret = $$varname;
    return $ret;
}