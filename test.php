<?php
define('IN_TG',true);
require dirname(__FILE__).'/includes/common.inc.php';


//putenv('TZ=Asia/Shanghai');
date_default_timezone_set('Asia/Shanghai');



 $word  = chr(mt_rand(176,215)).chr(mt_rand(176,215));
 $word = iconv('gb2312','utf-8',$word);
 echo $word;