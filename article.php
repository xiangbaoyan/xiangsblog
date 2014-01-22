<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        帖子详情
    </title>
    <style type="text/css">
        .source {
            width: 700px;
            font-size: 12px;
            border: 1px solid #AAAAAA;
            background-color: #F0F0EE;
            padding: 5px;
        }
        .source pre {
            margin: 0;
        }
        form {
            margin: 0;
        }
        .editor {
            margin-top: 5px;
            margin-bottom: 5px;
        }
    </style>
    <script type="text/javascript" charset="utf-8" src="/js/kindeditor.js"></script>
    <script type="text/javascript">
        KE.show({
            id : 'content2',
            cssPath : './index.css',
            items : [
                'undo', 'redo', 'fontname', 'fontsize', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
                'removeformat', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist']
        });
    </script>
    <?php
    define("IN_TG",true);
    define("SCRIPT",'article');
    require dirname(__FILE__).'/includes/common.inc.php';
    require ROOT_PATH.'includes/title.inc.php';
    ?>
</head>
<body>
<?php
require ROOT_PATH.'includes/header.inc.php';
//直接查询显示
if(!!@$_GET['articleId']){
    $sql = "SELECT tg_title,tg_content,tg_userName
              From tg_article
             WHERE tg_id='{$_GET['articleId']}'";
    $row = fetch_array($sql);
    $article = array();
    $article['title'] = $row['tg_title'];
    $article['content'] = $row['tg_content'];
    $article['userName'] = $row['tg_userName'];

    $result = query("SELECT tg_userName,tg_content,tg_title,tg_date
                       FROM tg_article
                      WHERE tg_reid='{$_GET['articleId']}'");
}else{
    exit("没有选择文章！！！！！！！！！！");
}


//添加回复
if(@$_GET['action']=='addRe' && isset($_COOKIE['userName']))
{
        if(!!$row=fetch_array("SELECT tg_uniqid
                                 FROM tg_user
                                WHERE tg_userName='{$_COOKIE['userName']}'
                                     "))
        {
            checkUniqid($row['tg_uniqid'],$_COOKIE['uniqid']);
            session_start();
            checkCode($_SESSION['code'],$_POST['yzm']);
            $re = array();
            $re['reid'] = $_POST['reid'];
            $re['title'] =checkTitle($_POST['title']);
            $re['content']=_mysql_string(checkContent($_POST['content']));
            $sql = "INSERT INTO tg_article(tg_userName,tg_reid,tg_title,tg_content,tg_date)
                         VALUES ('{$_COOKIE['userName']}',
                                 '{$re['reid']}',
                                 '{$re['title']}',
                                 '{$re['content']}',
                                 NOW()
                                  )";
            query($sql);
            if(mysql_affected_rows()==1){
                _alert_back("回复成功");
            }else{
                _alert_back("回复失败");
            }
        }

}
?>
    <div class="page-header">
        <h1><?php echo $article['title']?></h1>
    </div>
        <div id="author" class="row">
            <dl class="col-md-12">
                <dd class="message" >发消息</dd>
                <dd class="friend">加为好友</dd>
                <dd class="guest">写留言</dd>
                <dd class="flower">给他送花</dd>
                <dd class="user">作者:<?php echo $article['userName']?></dd>
            </dl>
        </div>

    <div class="row content ">

        <p><img src="/face/m01.gif" alt="m01"/>‘()’:&nbsp;&nbsp; &nbsp; &nbsp;<span>
                <?php
                    echo $article['content'];
                ?></span>
        </p>
    </div>

<?php

//$result = query("SELECT tg_userName,tg_content,tg_title,tg_date
//                       FROM tg_article");

   while(!!$row = mysql_fetch_array($result,MYSQL_ASSOC)){
       $html = array();
       $html['userName'] = $row['tg_userName'];
       $html['content'] = $row['tg_content'];
       $html['title'] = $row['tg_title'];
       $html['date'] = $row['tg_date'];

       $user = array();
       $sql = "SELECT tg_userName,tg_face
                 FROM tg_user
                WHERE tg_userName='{$html['userName']}'";
       $row = fetch_array($sql);
       if(mysql_affected_rows()==1){
           $user['userName'] = $row['tg_userName'];
           $user['face']= $row['tg_face'];
           ?>

s           <div class="reContent">
               <div class="col-md-2">
                   <dl>
                       <dd class="user"><?php echo $user['userName'] ?></dd>
                       <dt><img src="<?php echo $user['face'].'.gif'?>"></dt>
                       <dd class="message btn" >发消息</dd>
                       <dd class="friend btn">加为好友</dd>
                       <dd class="guest btn">写留言</dd>
                       <dd class="flower btn">给他送花</dd>
                   </dl>
               </div>

               <div class="col-md-10">
                   <div class="col-md-12" style="font-size: 12px;margin-top: 10px">
                       用户<?php echo $user['userName']?>于<?php echo $html['date']?>发表回复:
                   </div>
                   <div class="col-md-12" style="font-size: 12px;margin-top: 10px">
                       <?php echo $html['title']?>
                   </div>
                   <div class="col-md-12" style="font-size: 16px;margin-top: 40px">
                       <?php echo $html['content']?>
                   </div>
               </div>
           </div>

<?php
       }else{

       }

   }
?>

<script>
    window.onload = function(){
        var message = document.getElementsByClassName('message');
        for(i in message){
            message[i].onclick = function(){
                var user = $(this).siblings(".user").html().replace(/\(.*\)/,"");
                centerWindow('message.php?userName='+user,'message',350,420);
            }
        }


        var friend = document.getElementsByClassName('friend');
        for(i in friend){
            friend[i].onclick = function(){
                var user = $(this).siblings(".user").html().replace(/\(.*\)/,"");
                centerWindow('friend.php?userName='+user,'添加好友',350,420);
            }
        }


        var flower = document.getElementsByClassName('flower');
        for(i in flower){
            flower[i].onclick = function(){
                var user = $(this).siblings(".user").html().replace(/\(.*\)/,"");
                centerWindow('flower.php?userName='+user,'给他(她)送花',350,420);
            }
        }
    };
//    window.onload = function(){
//        var message = document.getElementsByClassName('message');
//        message[0].onclick = function(){
//            var user = $(this).siblings(".user").html().replace(/\(.*\)/,"");
//            centerWindow('message.php?userName='+user,'message',350,420);
//        };
//
//
//        var friend = document.getElementsByClassName('friend');
//        friend[0].onclick = function(){
//            var user = $(this).siblings(".user").html().replace(/\(.*\)/,"");
//            centerWindow('friend.php?userName='+user,'添加好友',350,420);
//        };
//
//
//        var flower = document.getElementsByClassName('flower');
//        flower[0].onclick = function(){
//            var user = $(this).siblings(".user").html().replace(/\(.*\)/,"");
//            centerWindow('flower.php?userName='+user,'给他(她)送花',350,420);
//        };
//    };
    function centerWindow(url,name,height,width){
        var top = (screen.height-height)/2;
        var left = (screen.width-width)/2;
        window.open(url,name,'height='+height+',width='+width+',top='+top+',left='+left);
    }
</script>

<div id="reply">
    <form role="form" method="post" action="?articleId=<?php echo $_GET['articleId']?>&action=addRe" class="form-horizontal col-md-offset-1">
        <input type="hidden" name="reid" value="<?php echo $_GET['articleId']?>"/>
        <div class="col-md-7">
            <strong>回复标题:</strong>
            <label>
                <input type="text" name="title" class="title" readonly value="RE:<?php echo $article['title']?>" />
            </label>

        </div>
        <div class="editor form-group">
            <label for="content2"></label>
            <textarea id="content2" name="content" style="width:500px;height:200px;visibility:hidden;"></textarea>
        </div>
        <div class="form-group">
            <label for="yzm" class="col-sm-2 control-label">验证码:</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="yzm" id="yzm" placeholder="请确认输入提示">
            </div>
            <img src="code.php" id="code">
            <button type="submit" class="btn btn-default">提交</button>
        </div>


    </form>
</div>

<?php
require ROOT_PATH.'includes/footer.inc.php';
?>
<script>
    var img = document.getElementById('code');
    img.onclick = function(){
        this.src = 'code.php?'+Math.random();
    }
</script>

</body>
</html>