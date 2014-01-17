<?php

define("IN_TG",true);
define("SCRIPT",'member_message');
require dirname(__FILE__).'/includes/common.inc.php';
require ROOT_PATH.'includes/title.inc.php';


 for($i=0; $i<100 ; $i++){

     $ct = array();

     $ct['toUser'] = 'master';

     $ct['fromUser'] = '用户'.$i;

     $ct['content'] = sha1(mt_rand()).sha1(mt_rand());

     $sql = "INSERT INTO tg_message(
                                      tg_toUser,
                                      tg_fromUser,
                                      tg_content,
                                      tg_date)
                  VALUES(
                                      '{$ct['toUser']}',
                                      '{$ct['fromUser']}',
                                      '{$ct['content']}',
                                      NOW()
                                      ) ";

     query($sql);
 }