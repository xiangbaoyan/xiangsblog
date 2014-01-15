window.onload = function(){
    var img = document.getElementsByTagName('img');
    for(var i = 0 ; i<img.length;i++){
        img[i].onclick = function(){
            _opener(this.alt);
        }
    }
};

function _opener(src){
    var faceImg = opener.document.getElementById('faceImg');
    opener.document.register.face.value = src ;
    faceImg.src = src;
}

