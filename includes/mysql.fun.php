<?php

    if(!defined('IN_TG')){
        exit('Access Denied');
    }

    function con_mysql(){
        global $con;
        if(!$con = @mysql_connect(DB_HOST,DB_USER,DB_PASSWORD)){
            exit('数据库连接失败');
        }
    }

    function select_db(){
        if(!mysql_select_db(DB_NAME)){
            exit('找不到指定的数据库');
        }
    }

    function select_names(){
        if(!mysql_query('SET NAMES UTF8')){
            exit('字符集错误');
        }
    }



    function query($sql){
        if(!$result = mysql_query($sql)){
            exit(mysql_error());
        }
        return $result;
    }

    function fetch_array($sql){
        return mysql_fetch_array(query($sql),MYSQL_ASSOC);
    }


    function is_repeat($sql,$info){
        if(fetch_array($sql)){
            _alert_back($info);
        }

    }
    function con_close(){
        if(!mysql_close()){
            exit("数据库关闭失败");
        };
    }





