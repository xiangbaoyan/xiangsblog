<?php


    function checkUniqid($firstUniqid,$endUniqid){
        if(strlen($firstUniqid) != 32 || $firstUniqid != $endUniqid){
            log_local(strlen($firstUniqid).'\n'.$firstUniqid.'\n'.$endUniqid);
            _alert_back("唯一标识符异常");
        }else{
            return $firstUniqid;
        }

    }

    function checkContent($str){
        if(mb_strlen($str,'utf-8') < 10 || mb_strlen($str)>100000){
            _alert_back("内容不得小于10位或者太大");
        }
        return $str;
    }

    function checkTitle($str){
        if(mb_strlen($str,'utf-8') < 2 || mb_strlen($str)>100){
            _alert_back("标题不得太小或者大于100个字节");
        }
        return $str;
    }

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

