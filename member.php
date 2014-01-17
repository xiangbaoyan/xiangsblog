<?php

define('IN_TG',true);

define('SCRIPT','member');


require dirname(__FILE__).'/includes/common.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <?php
    require ROOT_PATH.'/includes/title.inc.php';
    ?>
    <title></title>
</head>
<body>
<?php
require ROOT_PATH.'includes/header.inc.php';
?>

<div class="row">
    <?php
    require ROOT_PATH.'includes/member.inc.php';


    $row = fetch_array("select * from tg_user where tg_userName='{$_COOKIE['userName']}';");
    $_html = array();
    $_html['userName'] = $row["tg_userName"];
    $_html['question'] = $row["tg_question"];
    $_html['sex'] = $row["tg_sex"];
    $_html['face'] = $row["tg_face"];
    $_html['qq'] = $row["tg_qq"];
    $_html['email'] = $row["tg_email"];
    $_html['reg_time'] = $row["tg_reg_time"];

    switch($row['tg_level']){
        case '0':
            $_html['level'] = '普通会员';break;
        case '1':
            $_html['level'] = '管理员';break;
        default:
            $_html['level'] = '出错';
    };

    $_html = renHtml($_html);
    ?>

    <div class="col-md-7 ">
        <div class="panel panel-default">
            <div class="panel-heading">会员管理中心</div>
            <div class="panel-body" id="info">
                <ul>
                    <li>用&nbsp; 户&nbsp; 名:<span><?php echo $_html['userName']?></span></li>
                    <li>性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别: <span><?php echo $_html['sex']?></span></li>
                    <li>头&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;像: <span><img src="<?php echo $_html['face']?>.gif" alt="<?php echo $_html['face']?>"/></span></li>
                    <li>电子邮件: <span><?php echo $_html['email']?></span></li>
                    <li>Q&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Q: <span><?php echo $_html['qq']?></span></li>
                    <li>注册时间: <span><?php echo $_html['reg_time']?></span></li>
                    <li>身&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;份: <span><?php echo $_html['level']?></span></li>
                </ul>
                
            </div>
        </div>
    </div>


</div>





<?php
require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>


