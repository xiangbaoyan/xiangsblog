<?php
define('IN_TG',true);
define('SCRIPT','post');
session_start();
require dirname(__FILE__).'/includes/common.inc.php';

if(!isset($_COOKIE['userName'])){
    _alert_back("你还没有登录");
}

if(@$_GET['action'] == 'postBlog')
{
    if(!!$row = fetch_array("SELECT tg_uniqid
                               FROM tg_user
                              WHERE tg_userName='{$_COOKIE['userName']}'"))
    {
        checkUniqid($_COOKIE['uniqid'],$row['tg_uniqid']);
        checkCode($_POST['yzm'],$_SESSION['code']);
        $clean =  array();

        $clean['userName']=$_COOKIE['userName'];
        $clean['type']=$_POST['type'];
        $clean['title']=checkTitle($_POST['title']);
        $clean['content']=checkContent($_POST['content']);

        $sql = "INSERT tg_article(
                            tg_userName,
                            tg_type,
                            tg_title,
                            tg_content,
                            tg_date)
                VALUES (
                            '{$clean['userName']}',
                            '{$clean['type']}',
                            '{$clean['title']}',
                            '{$clean['content']}',
                            NOW()
                       )
                              ";
        query($sql);
        if(mysql_affected_rows()){
            con_close();
            _session_destroy();
            _alert_back("发表成功");
        }else{
            con_close();
            _session_destroy();
            _alert_back("没有发表成功");
        }



    }else{
        _alert_back("非法登录");
    }
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
    <div class="panel-heading">发布帖子</div>
    <div class="panel-body">

    <form role="form" class="form-horizontal" action="post.php?action=postBlog" method="post">
      <div class="form-group">
        <label class="col-md-3 control-label" >类型:</label>
        <div class="col-md-9" id="listType">

              <?php
              foreach(range(1,16) as $i){
                  if($i==1){
                      echo "
                    <input type='radio' name='type' id='type1' checked>
                    <label for='type1' ><img src='/images/icon1.gif'/></label>
                    ";
                  }else{
                     echo "
                    <input type='radio' name='type' id='type$i'>
                    <label for='type$i' ><img src='/images/icon{$i}.gif'/></label>
                    ";
                  }

              }
              ?>
          </div>
      </div>

     <div class="form-group">
         <label class="col-md-3 control-label" for="title">标题:</label>
         <div class="col-md-7">
             <input type="text" name="title" class="form-control" id="title"/>
         </div>
     </div>
    <div class="form-group">
         <label class="col-md-3 control-label" for="text">内容:</label>
         <div class="col-md-7">
             <textarea name="content" class="form-control" id="text" cols="30" rows="10">

             </textarea>
         </div>
     </div>

    <div class="form-group">
        <label for="yzm" class="col-md-3 control-label">验证码:</label>
        <div class="col-md-3">
            <input type="text" class="form-control" name="yzm" id="yzm" placeholder="请确认输入提示">
        </div>
        <img src="code.php" id="code">
    </div>

    <div class="form-group">
        <div class="col-md-offset-5 col-md-4">
            <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </div>
    </form>

    </div>
</div>


<?php
require ROOT_PATH."includes/footer.inc.php";
?>
</body>
</html>