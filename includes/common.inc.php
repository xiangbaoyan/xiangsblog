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
?>

