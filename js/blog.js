window.onload = function(){
    var message = document.getElementsByClassName('message');
    for(i in message){
        message[i].onclick = function(){
            var user = $(this).siblings(".user").html().replace(/\(.*\)/,"");
            centerWindow('message.php?userName='+user,'message',350,420);
        }
    }
};

function centerWindow(url,name,height,width){
    var top = (screen.height-height)/2;
    var left = (screen.width-width)/2;
    window.open(url,name,'height='+height+',width='+width+',top='+top+',left='+left);
}

