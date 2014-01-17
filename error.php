<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        错误页面
    </title>
    <style type="text/css">
        @font-face {
            font-family: 'laomao';
            src: url(font/maozedong.woff);
        }

        span {
            display: block;
            margin: 150px 0 0 270px;
            font-size: 200px;
            font-family: laomao,Arial, "Helvetica Neue", Helvetica, sans-serif;
        }

    </style>

</head>
<body>

     <span><?php echo $_GET['message']?></span>
</body>
</html>