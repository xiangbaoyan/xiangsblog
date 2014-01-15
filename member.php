<?php

define('IN_TG',true);

define('SCRIPT','member');


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
</head>
<body>
<?php
require ROOT_PATH.'includes/header.inc.php';
?>
    <div class="row">
        <div class="col-md-5 ">
            <div class="panel panel-default" id="user">
                <div class="panel-heading">中心导航</div>
                <div class="panel-body">
                    <div class="panel panel-default" id="user">
                                <div class="panel-heading">账号管理</div>
                                <div class="panel-body">

                                </div>
                    </div>
                </div>
            </div>

        </div>
    </div>





<?php
require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>


