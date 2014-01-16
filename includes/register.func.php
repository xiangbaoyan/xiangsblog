<?php


if(!function_exists('_alert_back')){

    exit('_alert_back()函数不存在,请检查');
};

function checkUserName($str,$min,$max){
    $str = trim($str);
    if(mb_strlen($str,'UTF-8')>$max)
    {
        _alert_back('输入用户名的长度不得大于'.$max.'个字节');
    }elseif(mb_strlen($str,'UTF-8')<$min){
        _alert_back('输入用户名的长度不得小于'.$min.'个字节');
    }else{
        return $str;
    };
    return null;
};

function checkUni($ses,$inp){
    if($ses != $inp){
        _alert_back("唯一标识符不正确");
    }
    return _mysql_string($inp);
}





