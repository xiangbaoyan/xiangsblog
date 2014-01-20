<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户信息详细内容</title>
    <?php
    define("IN_TG",true);
    define("SCRIPT",'member_message_detail');
    require dirname(__FILE__).'/includes/common.inc.php';
    require ROOT_PATH.'includes/title.inc.php';



    if(@$_GET['action']=='delete' && isset($_GET['delId'])){
        if(!!$_rows = fetch_array("SELECT tg_id
                                     FROM tg_message
                                    WHERE tg_id='{$_GET['delId']}'
                                    LIMIT 1"))
        {
            if(!!$_rows = fetch_array("SELECT tg_uniqid
                                         FROM tg_user
                                        WHERE tg_userName='{$_COOKIE['userName']}'
                                        LIMIT 1"))
            {
                checkUniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
                query("DELETE FROM
                                    tg_message
                           WHERE
                                    tg_id={$_GET['delId']}
                           LIMIT
                                    1");
                if(mysql_affected_rows() == 1){
                    con_close();
                    _session_destroy();
                    jumpUrl("删除成功",'member_message.php');
                }else{
                    con_close();
                    _session_destroy();
                    _alert_back("删除失败");
                }

            }
        }
    }
    ?>
</head>
<body>
<?php
require ROOT_PATH."includes/header.inc.php";
require ROOT_PATH.'includes/member.inc.php';
$id = @$_GET['me'];
if($id){
    $sql="UPDATE tg_message
             SET tg_state=1
           WHERE tg_id=$id";
    query($sql);
}
?>
<div class="col-md-7" id="detail">
   <?php
   $sql = "SELECT tg_fromUser,
                  tg_content,
                  tg_date
             FROM tg_message
            WHERE tg_id='$id'";
   $row = fetch_array($sql);
   ?>

    <div class="panel panel-default">
                <div class="panel-heading">短信详情</div>
                <div class="panel-body" id="detail">
                    <dl>
                        <dt>发信人</dt>
                        <dd><?php echo $row['tg_fromUser']?></dd>
                        <dt>发信日期</dt>
                        <dd><?php echo $row['tg_date']?></dd>
                        <dt>发信内容</dt>
                        <dd><?php echo $row['tg_content']?></dd>
                    </dl>
                </div>
                <button type="button" class="btn btn-primary" id="btn">
                           <i class="glyphicon glyphicon-arrow-left"></i>
                           <span>返回</span>
                </button>
                <button type="button" class="btn btn-primary" id="btn_delete" name="<?php echo $id?>">
                    <i class="glyphicon glyphicon-remove"></i>
                    <span>删除</span>
                </button>
        <script>
            var id =
            $('#btn').click(function(){
                history.back();
            });
            $('#btn_delete').click(function(){
                location.href = "member_message_detail.php?action=delete&delId="+this.name;
            });


        </script>
    </div>





</div>
</body>