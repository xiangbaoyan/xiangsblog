<!DOCTYPE html>
<?php
define('IN_TG',true);
define('SCRIPT','blog');
require dirname(__FILE__)."/includes/common.inc.php";
?>
<html>
<head>
    <title></title>
    <?php require ROOT_PATH."includes/title.inc.php" ?>
</head>
<body>

<?php
require ROOT_PATH."includes/header.inc.php";

?>


<div class="show">
    <?php
    $pageSize = 10;
    $num = mysql_num_rows(query('select tg_id from tg_user'));
    $pageSum = ceil($num/$pageSize);

    @$page = $_GET['page'];

    if(isset($page) && is_numeric($page) && $page>0 && $page<$pageSum+1){
        $page = intval($page);
    }else{
        $page = 1;
    }

    $pageNumStart = ($page-1)*$pageSize;

    $sql = "select tg_userName,tg_face,tg_sex from tg_user order by tg_id DESC LIMIT {$pageNumStart},{$pageSize}";

    $result = query($sql);
    while(!!$row = mysql_fetch_array($result,MYSQL_ASSOC)){
        ?>
        <dl>
            <dd class="user"><?php echo $row['tg_userName'] ?>(<?php echo $row['tg_sex'] ?>)</dd>
            <dt><img src="<?php echo $row['tg_face'].'.gif'; ?>" alt="<?php echo $row['tg_face']; ?>"></dt>
            <dd class="message btn">发消息</dd>
            <dd class="friend btn">加为好友</dd>
            <dd class="guest btn">写留言</dd>
            <dd class="flower btn">给他送花</dd>
        </dl>
    <?php }
        mysql_free_result($result);
        con_close();
    ?>

</div>

<div class="col-md-12 page" >
    <ul class="pagination">
        <li><a href="blog.php?page=<?php echo $page-1?>">&laquo;</a></li>

        <?php for($i = 0 ; $i < $pageSum;$i++){
        if(($i+1) == $page){ ?>
            <li class="active"><a href="blog.php?page=<?php echo $i+1?>"><?php echo $i+1 ?></a></li>
        <?php }else{ ?>
            <li><a href="blog.php?page=<?php echo $i+1?>"><?php echo $i+1 ?></a></li>
        <?php }} ?>
        <li><a href="blog.php?page=<?php echo $page+1?>">&raquo;</a></li>
    </ul>
</div>
<?php
require ROOT_PATH."includes/footer.inc.php"
?>
</body>
</html>