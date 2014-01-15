<?php
    define('IN_TG',true);
    define('SCRIPT','register');
    session_start();
    require dirname(__FILE__).'/includes/common.inc.php';
    include ROOT_PATH.'includes/register.func.php';

    if(@$_GET['action'] == 'register')
    {
        $_clean =  array();

        $_clean['unicode'] = checkUni($_SESSION['uni'],$_POST['uni']);
        if(!$_POST['yzm'] == $_SESSION['code'])
        {
            _alert_back('验证码不正确');
        };
        $_clean['userName'] = checkUserName($_POST['userName'],3,16);
        $_clean['password'] = $_POST['password'];
        $_clean['active'] = _sha_code();
        $_clean['question']= $_POST['question'];
        $_clean['answer']= $_POST['answer'];
        $_clean['QQ']= $_POST['QQ'];
        $_clean['email']= $_POST['email'];


        /**
         * 连接数据库
         */
        include ROOT_PATH.'includes/mysql.fun.php';
        define('DB_HOST','localhost');
        define('DB_USER','root');
        define('DB_PASSWORD','');
        define('DB_NAME','testguest');
        con_mysql();
        select_db();
        select_names();
        is_repeat("select tg_userName from tg_user where tg_userName = '".$_clean['userName']."'","此用户名已经存在");

        query(
            "INSERT INTO tg_user (
                                        tg_uniqid,
                                        tg_active,
                                        tg_username,
                                        tg_password,
                                        tg_question,
                                        tg_answere,
                                        tg_email,
                                        tg_qq)
                                VALUES (
                                        '{$_clean['unicode']}',
                                        '{$_clean['active']}',
                                        '{$_clean['userName']}',
                                        '{$_clean['password']}',
                                        '{$_clean['question']}',
                                        '{$_clean['answer']}',
                                        '{$_clean['email']}',
                                        '{$_clean['QQ']}'
                                );"
        );
        con_close();

        jumpIndex();

    }else{
        $_SESSION['uni'] = $uni = md5(uniqid(rand(),true));
    }



?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php require ROOT_PATH."includes/title.inc.php" ?>
    <script src="js/opener.js"></script>
</head>
<body>
  <?php
    require ROOT_PATH."includes/header.inc.php";
  ?>
  <div class="panel panel-default">
              <div class="panel-heading">用户注册</div>
              <div class="panel-body">

                  <form class="form-horizontal" role="form" name="register" method="post" action="register.php?action=register">
                      <input type="hidden" name='uni' value="<?php echo $uni ?>">
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
                          <label for="cPassword" class="col-sm-2 col-sm-offset-2 control-label">确认密码:</label>
                          <div class="col-sm-4">
                              <input type="password" class="form-control" id="cPassword" placeholder="请确认输入密码">
                          </div>
                          <span class="req">(*必填 至少六位*)</span>
                      </div>

                      <div class="form-group">
                          <label for="question" class="col-sm-2 col-sm-offset-2 control-label">密码提示:</label>
                          <div class="col-sm-4">
                              <input type="text" class="form-control" name="question" id="question" placeholder="请确认输入提示">
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="answer" class="col-sm-2  col-sm-offset-2 control-label">密码回答:</label>
                          <div class="col-sm-4">
                              <input type="text" class="form-control" name="answer" id="answer" placeholder="请确认输入密码">
                          </div>
                      </div>
                    <div class="row">
                        <label class = "col-sm-2  col-sm-offset-2 control-label">选择性别:</label>
                        <div class="radio col-sm-1 col-sm-offset-1">
                            <label>
                                <input type="radio" name="sex" id="man" value="男" checked>
                                男
                            </label>
                        </div>
                        <div class="radio col-sm-1">
                            <label>
                                <input type="radio" name="sex" id="women" value="女">
                                女
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <input type="text" name="face">
                        <img id="faceImg" onclick="window.open('face.php','face','width=400,height=400,top=0,left=0,scrollbars=1')" class="col-md-2 col-md-offset-5" src="face/m01.gif" alt="头像选择"/>
                    </div>


                  <div class="form-group">
                      <label for="answer" class="col-sm-2  col-sm-offset-2 control-label">QQ:</label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" name="QQ" id="" placeholder="请确认QQ">
                      </div>
                  </div>


                  <div class="form-group">
                      <label for="answer" class="col-sm-2  col-sm-offset-2 control-label">邮件:</label>
                      <div class="col-sm-4">
                          <input type="email" class="form-control" name="email" id="email" placeholder="请输入邮件">
                      </div>
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



<!--        <div class="panel-heading">会员注册</div>-->
<!--        <form  class="form-horizontal" role="form">-->
<!--          <div class="form-group">-->
<!--            <label for="userName" class="col-md-2">用户名:</label>-->
<!--            <div class="col-md-4">-->
<!--                <input type="email" class="form-control " id="userName" placeholder="请输入用户名">-->
<!--            </div>-->
<!--          </div>-->
<!--        </form>-->



  <?php
    require ROOT_PATH."includes/footer.inc.php";
  ?>
  </body>
</html>