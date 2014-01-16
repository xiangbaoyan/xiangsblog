<?php
define('IN_TG',true);
require dirname(__FILE__).'/includes/common.inc.php';


//putenv('TZ=Asia/Shanghai');
date_default_timezone_set('Asia/Shanghai');


echo date('Y-m-d H:i:s')."<br>";
echo strtotime(date('Y-m-d H:i:s'))."<br>";

echo time();