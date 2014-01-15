<?php

    if(!defined('IN_TG')){
        exit('Access Denied');
    }

    if (!function_exists('_alert_back')) {
        exit('_alert_back()函数不存在，请检查!');
    }

    if (!function_exists('_mysql_string')) {
        exit('_mysql_string()函数不存在，请检查!');
    }


    function checkTime($str){
       $time = array('0','1','2','3');
        if(!in_array($str,$time)){
            _alert_back('保存方式出错');
        }
        return $str;
    }


    function _setCookies($userName,$uniqid,$time){

        switch($time){
                 case '0':                       //浏览器进程
                     setcookie('userName',$userName);
                     setcookie('uniqid',$uniqid);break;
                 case '1':                       //一天
                     setcookie('userName',$userName,time()+86400);
                     setcookie('uniqid',$uniqid,time()+86400);break;
                 case '2':                       //一周
                     setcookie('userName',$userName,time()+604800);
                     setcookie('uniqid',$uniqid,time()+604800);break;
                 case '3':                       //一月
                     setcookie('userName',$userName,time()+2592000);
                     setcookie('uniqid',$uniqid,time()+2592000);break;       }

    }
