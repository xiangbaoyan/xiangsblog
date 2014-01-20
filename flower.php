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
        exit("不能给自己送花");
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
        $clean['flower'] = $_POST['flower'];
        $clean = _mysql_string($clean);


        query("INSERT INTO tg_flower (          tg_toUser,
                                                tg_fromUser,
                                                tg_flowerNum,
                                                tg_content,
                                                tg_date         )
                              VALUES  (
                                                '{$clean['toUser']}',
                                                '{$clean['fromUser']}',
                                                '{$clean['flower']}',
                                                '{$clean['content']}',
                                                NOW()           )
                                                ");
        if(mysql_affected_rows()){
            con_close();
            _session_destroy();
            _alert_back("您的花成功送出！");
        }else{
            con_close();
            _session_destroy();
            _alert_back("送花失败！！！");
        }
    }


    ?>
    <title>给他(她)送花</title>
</head>
<body>
<div class="pager-header">
    给他(她)送花
</div>
<form action="flower.php?action=write" method="post">
    <input type="hidden" value="<?php echo $userName?>" name="toUser">
    <div class="form-group">
        <label>
            <input id="in1" type="text" readonly class="form-control" value="写给:  <?php echo $userName ?>">
        </label>
        <label>
            <img src="/images/x4.gif" alt="flower"/> X
            <select name="flower">
                <option selected>1</option>
                <?php
                    for($i=2;$i<100;$i++){
                        echo "<option>$i</option>";
                    }
                ?>
            </select>
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
