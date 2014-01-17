<?php

if(!@$_COOKIE['userName']){
   header('location:error.php?message="请先登录"');
};

define('IN_TG',true);

define('SCRIPT','member_modify');


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
        <script src="js/opener.js"></script>
    </head>
<body>
<?php
require ROOT_PATH.'includes/header.inc.php';
?>

    <div class="row">
<?php
    require ROOT_PATH.'includes/member.inc.php';
    if( @$_GET['action'] == 'modify'){
        $row = fetch_array("select tg_uniqid from tg_user where tg_userName='{$_POST['userName']}'");
        if($row['tg_uniqid']!=$_COOKIE['uniqid']){
            header("error.php?message='小子攻击我么?'");
        }
    $clean = array();
        session_start();
        checkCode(@$_POST['yzm'],$_SESSION['code']);
        $_clean['password'] = @$_POST['password'];
        $_clean['sex'] = @$_POST['sex'];
        $_clean['face'] = str_replace(".gif","",@$_POST['face']);
        $_clean['email'] = @$_POST['email'];
        $_clean['qq'] = @$_POST['qq'];

        query("UPDATE tg_user SET
                                  tg_password='{$_clean['password']}',
                                  tg_face='{$_clean['face']}',
                                  tg_sex='{$_clean['sex']}',
                                  tg_email='{$_clean['email']}',
                                  tg_qq='{$_clean['qq']}'
                              WHERE
                                  tg_userName='{$_COOKIE['userName']}'
                                  ");
        if(mysql_affected_rows()==1){
           con_close();
           session_destroy();
           jumpUrl("修改成功","member_modify.php");
        }else{
           con_close();
           session_destroy();
           jumpUrl("什么也没有修改","member_modify.php");
        }
    }

    if(isset($_COOKIE['userName'])){


        $row = fetch_array("select * from tg_user where tg_userName = '{$_COOKIE['userName']}';");
        $_html = array();
        $_html['userName'] = $row["tg_userName"];
        $_html['password'] = $row["tg_password"];
        $_html['question'] = $row["tg_question"];
        $_html['face'] = $row["tg_face"];
        $_html['qq'] = $row["tg_qq"];
        $_html['email'] = $row["tg_email"];
        $_html['reg_time'] = $row["tg_reg_time"];



        if($row['tg_sex']=='女')
        {
            $_html['sex'] = '<div class="radio col-md-3 col-md-offset-2">
                         <label>
                         <input type="radio" name="sex"  value="男" >男
                         </label>
                         </div>
                         <div class="radio col-md-3 col-md-offset-2">
                         <label>
                         <input type="radio" name="sex"  value="女" checked>女
                         </label>
                         </div>
                         ';
        }else{
            $_html['sex'] = '<div class="radio col-md-3 col-md-offset-2">
                         <label>
                         <input type="radio" name="sex"  value="男" checked>男
                         </label>
                         </div>
                         <div class="radio col-md-3 col-md-offset-2">
                         <label>
                         <input type="radio" name="sex"  value="女" >女
                         </label>
                         </div>
                         ';
        }
    }

?>
    <div class="col-md-7 ">
        <div class="panel panel-default">
            <div class="panel-heading">修改资料</div>
            <div class="panel-body" id="info">
                <form role="form" name="myform" action="?action=modify" method="post" class="form-horizontal">

                  <div class="form-group">
                    <label for="userName" class="col-md-3 control-label">用户名:</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="userName" id="userName" readonly value="<?php echo $_html['userName']?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="password" class="col-md-3 control-label">密码:</label>
                    <div class="col-md-7">
                        <input type="password" class="form-control" name="password" id="password" value=
                        "<?php echo $_html['password'] ?>">
                    </div>
                  </div>

                  <div class="form-group">
                      <label for="sex" class="col-md-3 control-label">性别:</label>
                      <div class="col-md-5">
                            <?php echo $_html['sex']?>
                       </div>
                  </div>

                <div class="form-group">
                    <label for="face" class="col-md-3 control-label">头像:</label>
                    <img id="faceImg" onclick="window.open('face.php','face','width=400,height=400,top=0,left=0,scrollbars=1')"
                         class="col-md-2" src="<?php echo $_html['face']?>.gif" alt="头像选择">
                    <input type="text" name="face" id="face" class="col-md-2" value="<?php echo $_html['face']?>">
                </div>


                <div class="form-group">
                    <label for="email" class="col-md-3 control-label">Email:</label>
                    <div class="col-md-7">
                        <input type="email" class="form-control" name="email" id="userName" value="<?php echo $_html['email']?>">
                    </div>
                </div>


                <div class="form-group">
                    <label for="qq" class="col-md-3 control-label">Q Q:</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="qq" id="qq" value="<?php echo $_html['qq']?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="yzm" class="col-md-3 control-label">验证码:</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="yzm" id="yzm" placeholder="请确认输入提示">
                    </div>
                    <img  class="col-md-2" src="code.php" id="code">
                </div>
                   <button type="submit" class="btn btn-default">提交</button>
                </form>
            </div>
        </div>
    </div>

    </div>

</body>
