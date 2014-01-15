<?php
define('IN_TG',true);
require dirname(__FILE__).'/includes/common.inc.php';
con_mysql();
select_db();
select_names();

query("delete from tg_user;");

con_close();



?>