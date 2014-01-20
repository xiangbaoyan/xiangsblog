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
       exit("不能给自己发信息");
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


        query("INSERT INTO tg_message (         tg_toUser,
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
            _alert_back("发送成功");
        }
     }


    ?>
    <title>message</title>
</head>
<body>
    <div class="pager-header">
        写短信
    </div>
    <form action="message.php?action=write" method="post">
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
