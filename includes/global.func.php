<?php

function managerLogin(){
    if(!isset($_SESSION['admin'])||!isset($_COOKIE['userName'])){
        _alert_back("非法登录");
    }
}

function clearCookie(){
    setcookie('userName','',time()-1);
    setcookie('uniqid','',time()-1);
    session_destroy();
    jumpUrl(null,'index.php');
}

function checkCode($str,$ses){
    if($str != $ses){
        _alert_back('验证码出错');
    }
}

function login_state(){
    if(isset($_COOKIE['userName'])){
        _alert_back("用户登录状态，无法操作");
    }
}

function _runtime(){

    $_mtime= explode(" ",microtime());
    return $_mtime[1]+$_mtime[0];

};

function _mysql_string($str){
    if(!GPC){
        if(is_array($str)){
            foreach($str as $key=>$value){
            $str[$key] = _mysql_string($value);
            }
        }else{
            $str = mysql_real_escape_string($str);
        };

    }
    return $str;
}

function _alert_back($info){
    echo "<script>alert('{$info}');history.back();</script>;";
    exit();
}

function _code(){
    $str = '';
    for($i=0;$i<4;$i++)
    {
        $str.= dechex(mt_rand(0,15));
    };

    $_SESSION['code']= $str;

    $width = 75;
    $height = 25;

    $_img = imagecreatetruecolor($width,$height);

    $white = imagecolorallocate($_img,255,255,255);

    imagefill($_img,0,0,$white);

    $black = imagecolorallocate($_img,0,0,0);


    imagerectangle($_img,0,0,$width-1,$height-1,$black);


    for($i= 0;$i < 6;$i++){
        $_ran_color = imagecolorallocate($_img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
        imageline($_img,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),$_ran_color);
    };

    for($i = 0; $i < 100;$i++)
    {
        $_ran_color = imagecolorallocate($_img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
        imagestring($_img,1,mt_rand(1,$width),mt_rand(1,$height),'*',$_ran_color);
    };


    for($i = 0; $i < strlen($str) ; $i++)
    {
        $_ran_color = imagecolorallocate($_img,mt_rand(0,150),mt_rand(0,150),mt_rand(0,150));
        imagestring($_img,5,$i*$width/strlen($str)+mt_rand(1,10),mt_rand(1,$height/2),$str[$i],$_ran_color);
    };

    //输出图像
    header('Content-Type:image/png');

    imagepng($_img);

    imagedestroy($_img);
};

function _sha_code(){
    return sha1(uniqid(rand(),true));
}


/**
 * 带信息跳到指定页面
 * 弹出信息@param $info
 * 跳到的网址@param $url
 */
function jumpUrl($info,$url){
    if($info){
        echo "<script type='text/javascript'>alert('$info');location.href='{$url}';</script>";
    }else{
        header("location:$url");
    }
}
function test(){
    echo 'wocao ';
}

function renHtml($str){
    if(is_array($str)){
        foreach($str as $key => $value){
           $str[$key] = renHtml($value);
        }
    }else{
        htmlspecialchars($str);
    }
    return $str;
}

function log_local($str){
    file_put_contents('log_local.text',$str);
}

function _session_destroy() {
    if(@session_start()){
        session_destroy();
    }
}

?>