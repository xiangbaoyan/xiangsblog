<?php
if(!defined('IN_TG')){
    exit('Access Denied');
}

define('ROOT_PATH',substr(dirname(__FILE__),0,-8));

if(PHP_VERSION < '5.3.0'){
    exit("version is to low");
};

define('GPC',get_magic_quotes_gpc());
require ROOT_PATH."includes/global.func.php";

define('START_TIME',_runtime());
include ROOT_PATH.'includes/mysql.fun.php';
include ROOT_PATH.'includes/check.inc.php';



define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_NAME','testguest');


//
//define('DB_HOST','localhost');
//define('DB_USER','yufhlyvm_xiang');
//define('DB_PASSWORD','a19851985');
//define('DB_NAME','yufhlyvm_blog');

con_mysql();
select_names();
select_db();


if(isset($_COOKIE['userName'])){
    $sql = "SELECT COUNT(tg_id)
                 AS count
               FROM tg_message
              WHERE tg_toUser='{$_COOKIE['userName']}'
                AND tg_state=0";
    $row = mysql_fetch_array(query($sql),MYSQL_ASSOC);
    if(empty($row['count']))
    {
        $GLOBALS['message']= "<strong class='noread'><a href='member_message.php'>(0)</a></strong>";

    }else
    {
        $GLOBALS['message']= "<strong class='read'><a href='member_message.php'>({$row['count']})</a></strong>";
    }

}


?>

