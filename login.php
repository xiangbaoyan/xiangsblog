<!DOCTYPE html>
<html>
<head>
    <?php
    if(!!@$_COOKIE['userName']){
        exit("请先退出再登录");
    }
    session_start();
    define('IN_TG',true);
    define('SCRIPT','login');
    require dirname(__FILE__).'/includes/common.inc.php';
    require ROOT_PATH.'includes/title.inc.php';
    require ROOT_PATH.'includes/login.func.php';
    if(@$_GET['action']=='login'){
        checkCode($_POST['yzm'],$_SESSION['code']);
        $_clean = array();
        $_clean['userName'] = $_POST['userName'];
        $_clean['password'] = $_POST['password'];
        $_clean['saveTime'] = checkTime($_POST['saveTime']);

        $sql = "SELECT tg_userName,tg_uniqid
                FROM tg_user where tg_userName='".$_clean['userName']."'
                AND tg_password ='".$_clean['password']."'";

        if($rows = fetch_array($sql)){
            con_close();
            session_destroy();
            _setCookies($rows['tg_userName'],$rows['tg_uniquid'],$_clean['saveTime']);
            jumpUrl(null,"index.php");
        }else{
            con_close();
            session_destroy();
            jumpUrl("用户名或者密码不正确","login.php");
        };

    }
    ?>
    <script src="js/login.js"></script>
</head>
<body>
    <?php
    require ROOT_PATH.'includes/header.inc.php';
    ?>
    <div class="panel panel-default">
    <div class="panel-heading">用户登录</div>
    <div class="panel-body">

        <form class="form-horizontal" role="form" name="login" method="post" action="login.php?action=login">
            <div class="form-group">
                <label for="userName" class="col-sm-2 col-sm-offset-2 control-label">用户名:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control"  name="userName" id="userName" placeholder="请输入用户名">
                </div>
                <span class="req">(*必填 至少两位*)</span>
            </div>

            <div class="form-group">
                <label for="password" class="col-sm-2 col-sm-offset-2 control-label">密码:</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" name="password" id="password" placeholder="请输入密码">
                </div>
                <span class="req">(*必填 至少六位*)</span>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 col-sm-offset-2 control-label">保留:</label>
                <div class="col-sm-4" id="radio">
                    <label for="saveTime1">不保留</label>
                    <input type="radio" name="saveTime" id="saveTime1" value="0">
                    <label for="saveTime2">一天</label>
                    <input type="radio" name="saveTime" id="saveTime2" value="1">
                    <label for="saveTime3">一周</label>
                    <input type="radio" name="saveTime" id="saveTime3" value="2">
                    <label for="saveTime4">一月</label>
                    <input type="radio" name="saveTime" id="saveTime4" value="3">
                </div>
                <span class="req">(*必填 至少六位*)</span>
            </div>




            <div class="form-group">
                <label for="yzm" class="col-sm-2 col-sm-offset-2 control-label">验证码:</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="yzm" id="yzm" placeholder="请确认输入提示">
                </div>
                <img src="code.php" id="code">
            </div>


            <button type="submit" class="btn btn-default col-md-offset-5">提交</button>
        </form>

    </div>
    </div>
    <?php
    require ROOT_PATH.'includes/footer.inc.php';
    ?>
</body>
</html>