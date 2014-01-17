<?php

    if(!defined('IN_TG')){
        exit('无访问权限');
    }


?>
    <link rel="stylesheet" href="../style/1/member.inc.css"/>
    <div class="col-md-5 ">
        <div class="panel panel-default">
            <div class="panel-heading ">中心导航</div>
                <div class="panel-body inc">
                <div class="panel panel-success">
                    <div class="panel-heading">账号管理</div>
                    <div class="list-group">
                            <a href="member.php" class="list-group-item">个人信息</a>
                            <a href="member_modify.php" class="list-group-item">修改资料</a>
                    </div>
                </div>


                <div class="panel panel-success">
                    <div class="panel-heading">其他管理</div>
                    <div class="list-group">
                        <a href='member_message.php' class="list-group-item">短信查阅</a>
                        <a class="list-group-item">好友设置</a>
                        <a class="list-group-item">查询花朵</a>
                        <a class="list-group-item">个人相册</a>
                    </div>
                </div>
            </div>
        </div>
    </div>