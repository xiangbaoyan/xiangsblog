<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户信息列表</title>
    <?php
    define("IN_TG",true);
    define("SCRIPT",'member_flower');
    require dirname(__FILE__).'/includes/common.inc.php';
    require ROOT_PATH.'includes/title.inc.php';


    if(@$_GET['action']=='delete' && isset($_POST['ids'])){
        if(!!$_rows = fetch_array("SELECT tg_uniqid
                                         FROM tg_user
                                        WHERE tg_userName='{$_COOKIE['userName']}'
                                        LIMIT 1")){
            checkUniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
            $ids = _mysql_string(implode(",",$_POST['ids']));

            query("DELETE FROM tg_flower
                             WHERE tg_id
                                IN ({$ids})");

            if(mysql_affected_rows()){
                con_close();
                jumpUrl("删除成功","member_flower.php");
            }else{
                con_close();
                _alert_back("短信删除失败");
            }

        }else{
            _alert_back("非法登录");
        }
    }
    ?>
</head>
<body>
<?php
require ROOT_PATH."includes/header.inc.php";
require ROOT_PATH.'includes/member.inc.php';
?>
<div class="col-md-7">
    <form action="?action=delete" method="post">
        <table class="table table-bordered">
            <thead><tr><th>发信人</th><th>短信内容</th><th>时间</th><th>收到的花</th><th>操作</th></tr></thead>
            <?php
            $pageSize = 5;
            $num = mysql_num_rows(query("SELECT tg_id
                                          FROM tg_flower
                                         WHERE tg_toUser='{$_COOKIE['userName']}'"));

            $pageSum = ceil($num/$pageSize);

            @$page = $_GET['page'];

            if(isset($page) && is_numeric($page) && $page>0 && $page<$pageSum+1){
                $page = intval($page);
            }else{
                $page = 1;
            }
            $pageNumStart = ($page-1)*$pageSize;

            $sql = "SELECT tg_fromUser,
                          tg_id,
                          tg_content,
                          tg_flowerNum,
                          tg_date
                     FROM tg_flower
                    WHERE tg_toUser='{$_COOKIE['userName']}'
                 ORDER BY tg_id
                     DESC
                    LIMIT {$pageNumStart},
                          {$pageSize}";
            $result = query($sql);
            while(!!$row = mysql_fetch_array($result,MYSQL_ASSOC)){
                ?>
                <tr>
                    <td><?php echo $row['tg_fromUser'] ?></td>
                    <td><a href="member_flower_detail.php?me=<?php echo $row['tg_id']?>">
                            <?php echo substr($row['tg_content'],0,20)."..." ?></a></td>
                    <td><?php echo $row['tg_date'] ?></td>
                    <td><?php
                        echo "<img src='/images/x4.gif'/>"." X {$row['tg_flowerNum']}";
                        ?></td>
                    <td><label><input type="checkbox" class="check" name="ids[]" value="<?php echo $row['tg_id']?>"></td>
                </tr>


            <?php
            }
            mysql_free_result($result);
            con_close();
            ?>
        </table>

        <button type="button" class="btn btn-primary" id="btn-all">
            <i class="glyphicon glyphicon-ok"></i>
            <span>全选</span>
        </button>
        <button type="submit" class="btn btn-primary" id="btn-delete">
            <i class="glyphicon glyphicon-remove"></i>
            <span>删除</span>
        </button>
    </form>
    <div class="col-md-12 page" >
        <ul class="pagination">
            <li><a href="member_flower.php?page=<?php echo $page-1?>">&laquo;</a></li>

            <?php for($i = 0 ; $i < $pageSum;$i++){
                if(($i+1) == $page){ ?>
                    <li class="active"><a href="member_flower.php?page=<?php echo $i+1?>"><?php echo $i+1 ?></a></li>
                <?php }else{ ?>
                    <li><a href="member_flower.php?page=<?php echo $i+1?>"><?php echo $i+1 ?></a></li>
                <?php }} ?>
            <li><a href="member_flower.php?page=<?php echo $page+1?>">&raquo;</a></li>
        </ul>
    </div>
</div>

<script type="text/javascript">
    $("#btn-all").click(function(){
        var flag=true;
        $("input[type='checkbox']").each(function(){
            if(!$(this).prop('checked')){
                $(this).prop("checked",true);
                flag=false;
            }
        });
        if(flag==true){
            $(".check").each(function(){
                $(this).prop('checked',false);
            });
        }

    });
</script>


<?php
require ROOT_PATH."includes/footer.inc.php";
?>
</body>
</html>