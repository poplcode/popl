<?php
function popl_prehandle_param(){
    foreach(['get' => $_GET, 'post' =>$_POST] as $key=>$params){
        $new_arr = [];        
        
        foreach($params as $param_key =>$param_value){
            // 배열 걸러내기
            if (is_string($param_value) === false){
                $new_key = "__popl_origin_" . $param_key;
                $new_arr[$new_key] = $param_value;
            }else{
                $new_arr[$param_key] = $param_value;
            }

            if (popl_str_contains($param_key, "__")){
                $split_values = popl_str_split($param_key, "__");
                $param_name = $split_values[0];
                $valid_rules = $split_values[1];
                $default_value = false;
                if (count($split_values) == 3){
                    $default_value = $split_values[2];
                }
            }
        }
    }
}
