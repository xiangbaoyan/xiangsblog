window.onload = function(){
    var message = document.getElementsByClassName('message');
    for(i in message){
        message[i].onclick = function(){
            var user = $(this).siblings(".user").html().replace(/\(.*\)/,"");
            centerWindow('message.php?userName='+user,'message',350,420);
        }
    }


    var friend = document.getElementsByClassName('friend');
    for(i in friend){
        friend[i].onclick = function(){
            var user = $(this).siblings(".user").html().replace(/\(.*\)/,"");
            centerWindow('friend.php?userName='+user,'添加好友',350,420);
        }
    }


    var flower = document.getElementsByClassName('flower');
    for(i in flower){
        flower[i].onclick = function(){
            var user = $(this).siblings(".user").html().replace(/\(.*\)/,"");
            centerWindow('flower.php?userName='+user,'给他(她)送花',350,420);
        }
    }
};

function centerWindow(url,name,height,width){
    var top = (screen.height-height)/2;
    var left = (screen.width-width)/2;
    window.open(url,name,'height='+height+',width='+width+',top='+top+',left='+left);
}

