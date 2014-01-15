/**
 * Created by Administrator on 14-1-13.
 */
window.onload = function(){
    var code = document.getElementById('code');
    code.onclick = function(){
        this.src =  'code.php?'+Math.random();
    }
};