<!--  页头介绍 -->
<?php
    if(!defined('IN_TG')){
        exit('Access Denied!');
    }
?>
<div class="jumbotron" id="header">
    <div class="container pull-left">
        <h1>小象网络俱乐部</h1>
        <span class="label label-default pull-right" >小象网络俱乐部</span>
    </div>

    <nav class="navbar navbar-default navbar-right">
        <div class="collapse navbar-collapse" >
            <ul class="nav navbar-nav">

                <?php
                    if(@$_COOKIE['userName']){?>
                <li><a href="index.php">首页</a></li>
                <li><a href="member.php"><?php echo $_COOKIE['userName']?>的个人中心</a></li>
                <li><a href="#">风格</a></li>
                <li><a href="#">管理</a></li>
                <li><a href="blog.php">博友</a></li>
                <li><a href="logOut.php">退出</a></li>
                <?php }else{ ?>
                <li><a href="index.php">首页</a></li>
                <li><a href="register.php">注册</a></li>
                <li><a href="login.php">登录</a></li>
                <li><a href="#">风格</a></li>
                <li><a href="#">管理</a></li>
                <li><a href="blog.php">博友</a></li>
                <?php   }?>


            </ul>
        </div>
    </nav>
</div>