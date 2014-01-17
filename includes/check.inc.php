<?php


    function checkUniqid($firstUniqid,$endUniqid){
        if(strlen($firstUniqid) != 32 || $firstUniqid != $endUniqid){
            log_local(strlen($firstUniqid).'\n'.$firstUniqid.'\n'.$endUniqid);
            _alert_back("唯一标识符异常");
        }
    }

    function checkContent($str){
        if(mb_strlen($str) < 10 || mb_strlen($str)>200){
            _alert_back("短信内容不得小于10位或者大于200位");
        }
        return $str;
    }