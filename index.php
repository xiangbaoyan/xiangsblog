<!DOCTYPE html>
<?php
define('IN_TG',true);
define('SCRIPT','index');
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
<!--页中框体-->
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default" id="user">
            <div class="panel-heading">新进会员</div>
            <div class="panel-body"></div>
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

            </div>
        </div>
    </div>
</div>
<?php
    require ROOT_PATH."includes/footer.inc.php"
?>

</body>
</html>