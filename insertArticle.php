<?php
define('IN_TG',true);
require dirname(__FILE__).'/includes/common.inc.php';
for($i=0;$i<100;$i++)
{
    $clean =  array();

    $clean['userName']= "用户".mt_rand(1,200000);
    $clean['type']=mt_rand(1,16);
    $clean['title']= getHan(20);
    $clean['content']=getHan(350);

    $sql = "INSERT tg_article(
                            tg_userName,
                            tg_type,
                            tg_title,
                            tg_content,
                            tg_date)
                VALUES (
                            '{$clean['userName']}',
                            '{$clean['type']}',
                            '{$clean['title']}',
                            '{$clean['content']}',
                            NOW()
                       )
                              ";
    query($sql);
}



function getHan($num){

    $str ="";

    for($i=0; $i<$num; $i++){
        $word = chr(mt_rand(176,215)).chr(mt_rand(176,215));
        $word = iconv("gb2312","utf-8",$word);
        $str.=$word;
    }

    return  $str;
}