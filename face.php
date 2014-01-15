<?php
    define('IN_TG',true);
    define('SCRIPT','face');
    require dirname(__FILE__).'/includes/common.inc.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <?php require ROOT_PATH."includes/title.inc.php" ?>
        <script src="js/face.js"></script>
    </head>
    <body>
   <div id="face">
       <h3>选择头像</h3>

       <?php foreach(range(1,9) as $num){?>
          <dl>
              <dd><img src="face/m0<?php echo $num ?>.gif" alt="face/m0<?php echo $num ?>.gif"></dd>
          </dl>
        <?php } ?>

       <?php foreach(range(10,64) as $num){?>
           <dl>
               <dd><img src="face/m<?php echo $num ?>.gif" alt="face/m<?php echo $num ?>.gif"></dd>
           </dl>
       <?php } ?>
   </div>
    </body>
</html>