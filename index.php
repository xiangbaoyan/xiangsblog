<!DOCTYPE html>
<?php
define('IN_TG',true);
define('SCRIPT','index');
require dirname(__FILE__)."/includes/common.inc.php";
?>
<html>
  <head>
    <title></title>
    <?php require ROOT_PATH."includes/title.inc.php"?>
    <link rel="stylesheet" href="/style/1/blog.css"/>
    <script src="/js/blog.js"></script>
  </head>
  <body>

<?php
    require ROOT_PATH."includes/header.inc.php";
?>
<!--页中框体-->
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default" id="user">
            <div class="panel-heading">新进会员</div>
            <div class="panel-body">
                <dl>
                    <?php
                    $sql = "SELECT tg_userName,tg_face,tg_sex,tg_email,tg_qq
                              FROM tg_user
                          ORDER BY tg_reg_time
                              DESC
                             LIMIT 1";

                    $result = mysql_query($sql);
                    $row = mysql_fetch_array($result,MYSQL_ASSOC);
                    ?>
                    <dd class="user"><?php echo $row['tg_userName'] ?>(<?php echo $row['tg_sex'] ?>)</dd>
                    <dt><img src="<?php echo $row['tg_face'].'.gif'; ?>" alt="<?php echo $row['tg_face']?>"></dt>
                    <dd class="message btn" >发消息</dd>
                    <dd class="friend btn">加为好友</dd>
                    <dd class="guest btn">写留言</dd>
                    <dd class="flower btn">给他送花</dd>
                </dl>
                <span id="sp1">电子邮箱:<span class="sp"><?php echo $row['tg_email'];
                        mysql_free_result($result);
                        ?></span>&nbsp;&nbsp;&nbsp;QQ:<span class="sp"><?php echo $row['tg_qq']?></span></span>
            </div>
        </div>
        <div class="panel panel-default" id="pics">
            <div class="panel-heading">最新图片</div>
            <div class="panel-body"></div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="panel panel-default " id="list">
            <div class="panel-heading">贴子列表</div>
            <div class="panel-body">
            <a href="post.php" class="post">发表帖子</a>
            <ul class="article">
                <?php

                $row = fetch_array("SELECT COUNT(tg_id) AS count FROM tg_article" );
                $pageSize = 10;
                $itemsSum = $row['count'];
                $pageSum = ceil($itemsSum/$pageSize);
                $page = intval(@$_GET['page']);
                if(isset($page) && $page<=$pageSum && $page>0){

                }else{
                    $page = 0;
                }

                $sql1 = "SELECT *
                           FROM tg_article
                       ORDER BY tg_id
                           DESC
                          LIMIT ".$page*$pageSize.",$pageSize";
                $result1 = query($sql1);
                while(!!$row1 = mysql_fetch_array($result1,MYSQL_ASSOC)){
                    $htmlList = array();
                    $htmlList['id'] = $row1['tg_id'];
                    $htmlList['type'] = $row1['tg_type'];
                    $htmlList['title'] = mb_substr($row1['tg_title'],0,22,'utf-8').'...';

                 echo "
                <li class='icon{$htmlList['type']}'>
                <em>阅读数(<strong>72</strong>) 评论数(<strong>2</strong>)</em>
                <a href='article.php?articleId={$htmlList['id']}'>{$htmlList['title']}</a></li>
                 ";
                }
                ?>
            </ul>

            <div class="col-md-12 page" >
                <ul class="pagination">
                    <li><a href="index.php?page=<?php echo $page-1?>">&laquo;</a></li>

                    <?php for($i = 0 ; $i < $pageSum;$i++){
                        if(($i+1) == $page){ ?>
                            <li class="active"><a href="index.php?page=<?php echo $i+1?>"><?php echo $i+1 ?></a></li>
                        <?php }else{ ?>
                            <li><a href="index.php?page=<?php echo $i+1?>"><?php echo $i+1 ?></a></li>
                        <?php }} ?>
                    <li><a href="index.php?page=<?php echo $page+1?>">&raquo;</a></li>
                </ul>
            </div>
            </div>
        </div>
    </div>
</div>
<?php
    require ROOT_PATH."includes/footer.inc.php"
?>

</body>
</html>