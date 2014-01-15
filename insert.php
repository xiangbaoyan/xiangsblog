<?php
define('IN_TG',true);
require dirname(__FILE__).'/includes/common.inc.php';

for($i=1;$i<50;$i++){
    $_clean =  array();
    $_clean['unicode'] = md5($i);
    $_clean['active'] = md5($i."salt");
    $_clean['userName'] = _mysql_string("用户".($i+1));
    $_clean['password'] = substr(md5($i),0,10);
    $_clean['question'] = 'hello'.$i;
    $_clean['answer'] ='hello'.$i;
    $_clean['email'] = substr(md5($i),0,5).'@163.com';
    $_clean['QQ'] = substr(md5($i),20,27);
    $_clean['sex'] = _mysql_string($i%2==0?'男':'女');
    if($i<10){
        $_clean['face'] = 'face/m0'.$i;
    }else{
        $_clean['face'] = 'face/m'.$i;
    }

    query(
        "INSERT INTO tg_user (
                                        tg_uniqid,
                                        tg_active,
                                        tg_username,
                                        tg_password,
                                        tg_sex,
                                        tg_question,
                                        tg_answere,
                                        tg_email,
                                        tg_qq,
                                        tg_face)
                                VALUES (
                                        '{$_clean['unicode']}',
                                        '{$_clean['active']}',
                                        '{$_clean['userName']}',
                                        '{$_clean['password']}',
                                        '{$_clean['sex']}',
                                        '{$_clean['question']}',
                                        '{$_clean['answer']}',
                                        '{$_clean['email']}',
                                        '{$_clean['QQ']}',
                                        '{$_clean['face']}'
                                );"
    );

}

con_close();



?>