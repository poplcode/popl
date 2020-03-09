<?php
function popl_db_get_pdo(){
    $db_config = popl_import_config("db");    
    $host = $db_config['host'];
    $port = $db_config['port'];
    $dbname=$db_config['dbname'];
    $charset=$db_config['charset'];
    $username = $db_config['username'];
    $db_pw = $db_config['password'];
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
    $pdo = new PDO($dsn, $username, $db_pw);
    return $pdo;
}

// Create, Update, Delete
function popl_db_execute($query, $param){
    $pdo = popl_db_get_pdo();
    $st = $pdo->prepare($query);
    $result = $st->execute($param);
    $pdo = null;
    return $result;
}

// select
function popl_db_fetch_all($query, $param){
    $pdo = popl_db_get_pdo();
    $st = $pdo->prepare($query);
    $st->execute($param);
    $result =$st->fetchAll(PDO::FETCH_ASSOC);
    $pdo = null;
    return $result;
}

function popl_db_make_terms($kvParam=[]){
    $terms = array();
    foreach ($kvParam as $key=>$value){
        array_push($terms, "$key = :$key");
    }

    // and 의 공백에 주의
    $where = implode(" and ", $terms);

    if (popl_str_trim($where) !== ''){
        $where = " where " . $where;
    }
    return $where;
}

function popl_db_make_orderby($orderby){
    if (popl_str_trim($orderby) !== '') {
        $orderby = " order by " . $orderby;
    }
    return $orderby;
}

function popl_db_make_limit($limit){
    if ($limit == null){
        return "";
    }

    return " limit $limit";
}

function set_upsert_date_column($row){
    if (popl_array_has_key($row, "insert_date") 
        && popl_array_has_key($row, "update_date")
        && popl_array_has_key($row, "upsert_date") === false    
        ){
        $row['upsert_date'] = $row['update_date'] != null ? $row['update_date'] : $row['insert_date'];
    }else{
        $row['upsert_date'] = null;
    }    

    return $row;
}

function popl_db_select($table_name, $kvParam=[], $orderby='', $limit=null){
    $terms = popl_db_make_terms($kvParam);
    $orderby = popl_db_make_orderby($orderby);
    $limit = popl_db_make_limit($limit);
    $query = "select * from $table_name $terms $orderby $limit";
    $result =  popl_db_fetch_all($query, $kvParam);    
    foreach ($result as $idx => $row){
        $row = set_upsert_date_column($row);
        $result[$idx] = $row;
    }
    return $result;
}

function popl_db_select_first($table_name, $kvParam=[], $orderby=''){
    $result = popl_db_select($table_name, $kvParam, $orderby, 1);
    if (count($result) == 1){
        $result = $result[0];        
        return $result;
    }

    return null;
}

function popl_db_select_first_by_id($table_name, $id){
    return popl_db_select_first($table_name, ['id'=>$id]);
}

function popl_db_select_exist($table_name, $kvParam=[]){
    $result = popl_db_select_first($table_name, $kvParam);    
    return $result !== null;
}

function popl_db_select_paging($table_name, $page_no, $kvParam=[], $orderby='insert_date desc', $count_per_page=10){
    $offset = ($page_no -1) * $count_per_page;
    return popl_db_select($table_name, $kvParam, $orderby, "$offset,$count_per_page");
}

function popl_db_insert($table_name, $kvparam=[]){    
    $columns = array_keys($kvparam);    
    $value_placeholders = array_map(
        function($key){
            return ":$key";
        },
        $columns);

    $strColumn = implode(",",$columns);
    $strValuePlaceHolders = implode(",",$value_placeholders);

    $query = "insert into $table_name ($strColumn) values ($strValuePlaceHolders)";

    return popl_db_execute($query, $kvparam);
}

function popl_db_set_default_values($kvparam, $default_key_vals){
    foreach($default_key_vals as $default_key => $default_val){
        if (popl_array_has_key($kvparam, $default_key) === false){
            $kvparam[$default_key] = $default_val;
        }
    }    
    return $kvparam;
}

function popl_db_insert_standard($table_name, $kvparam){
    $default_key_vals = [
        "use_yn" => "Y",
        "insert_date" => date("Y-m-d H:i:s") 
    ];

    $kvparam = popl_db_set_default_values($kvparam, $default_key_vals);

    return popl_db_insert($table_name, $kvparam);    
}