<?php
const DEFAULT_FLASH_MESSAGE_KEY = "FLASH_MESSAGE";

function popl_flash_set($val, $key="FLASH_MESSAGE"){    
    popl_cookie_set_array($key, $val);
}

function popl_flash_get($key="FLASH_MESSAGE"){    
    return popl_cookie_get_array($key);
}

function popl_flash_show($prefix_item='',$suffix_item='', $prefix_whole='',$suffix_whole='', $key="FLASH_MESSAGE"){    
    $ret = '';
    $ret .= $prefix_whole;
    $items = popl_flash_get($key);    
    foreach($items as $item){
        $ret .= $prefix_item;
        $ret .= $item;
        $ret .= $suffix_item;
    }
    $ret .= $suffix_whole;
    echo $ret;

    popl_cookie_remove($key);
}