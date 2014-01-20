<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <?php
    session_start();
    if(!@$_COOKIE['userName']){
        echo "<script>alert('请先登录!');window.close();</script>";
    }
    define('IN_TG',true);
    define('SCRIPT','message');
    require dirname(__FILE__).'/includes/common.inc.php';
    require ROOT_PATH.'includes/title.inc.php';
    $userName = @$_GET['userName'];

    if(@$_COOKIE['userName'] == $userName){
        exit("不能添加自己为好友");
    }
    if(@$_GET['action']=='write')
    {
        checkCode($_POST['yzm'],$_SESSION['code']);
        if(!!$row = fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_userName='{$_COOKIE['userName']}'"))
        {
            checkUniqid($_COOKIE['uniqid'],$row['tg_uniqid']);
        }
        $clean = array();
        $clean['toUser'] = $_POST['toUser'];
        $clean['fromUser'] = $_COOKIE['userName'];
        $clean['content'] = checkContent($_POST['content']);

        $clean = _mysql_string($clean);

        if($clean['toUser']==$clean['fromUser']){
            jumpUrl(null,"error.php?message=不能加自己好友");
            exit();
        }



        if(!!$row = fetch_array("SELECT tg_id
                                   FROM tg_friend
                                  WHERE tg_toUser='{$clean['toUser']}'
                                    AND tg_fromUser = '{$clean['fromUser']}'

                                     OR tg_toUser = '{$clean['fromUser']}'
                                    AND tg_fromUser = '{$clean['toUser']}'
                                  LIMIT 1
                                    ")){

            _alert_back("你们已经是好友了!或者是未验证的好友,不用添加");

        }

        query("INSERT INTO tg_friend (         tg_toUser,
                                                tg_fromUser,
                                                tg_content,
                                                tg_date         )
                              VALUES  (
                                                '{$clean['toUser']}',
                                                '{$clean['fromUser']}',
                                                '{$clean['content']}',
                                                NOW()           )
                                                ");
        if(mysql_affected_rows()){
            con_close();
            _session_destroy();
            _alert_back("好友添加成功!请等待验证");
        }else{
            con_close();
            _session_destroy();
            _alert_back("好友添加失败!");
        }
    }


    ?>
    <title>添加好友</title>
</head>
<body>
<div class="pager-header">
    添加好友
</div>
<form action="friend.php?action=write" method="post">
    <input type="hidden" value="<?php echo $userName?>" name="toUser">
    <div class="form-group">
        <label>
            <input type="text" readonly class="form-control" value="写给:  <?php echo $userName ?>">
        </label>
    </div>
    <div class="form-group">
        <label>
            <textarea class="form-control" name="content" cols="50" rows="5"></textarea>
        </label>
    </div>

    <div class="form-group" id="verify">
        <label for="yzm" class="col-xs-3">验证码:</label>
        <div class="col-xs-5">
            <input type="text" class="form-control" name="yzm" id="yzm" placeholder="请输入验证码">
        </div>
        <img src="code.php" id="code">
    </div>
    <button type="submit" class="btn btn-default">发送</button>

    <script type="text/javascript">
        var code = document.getElementById('code');

        code.onclick = function(){
            this.src = "code.php?"+Math.random();
        };
    </script>
</form>
</body>
</html>
