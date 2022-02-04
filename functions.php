<?php
function checkEmpty($data){
    $flag = false;
    if(empty($data)){
        $flag = true;
    }
    return $flag;
}

function checkLength($data, $min, $max){
    $length = strlen($data);
    $flag = false;
    if(!empty($data)){
        if($length < $min || $length > $max){
            $flag = true;
        }
    }
    return $flag;
}

function parseFileIni(){
    $data = parse_ini_file('config/config.ini');
    return $data;
}
