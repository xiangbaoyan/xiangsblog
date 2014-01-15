window.onload = function(){
    var img = document.getElementById('code');

    img.onclick = function(){
       // alert('ok');
        this.src = "code.php?" + Math.random();
    }




    var form = document.getElementsByTagName('form')[0];

    form.userName.focus();


        form.onsubmit = function(){
            if( form.userName.value.length < 2 || form.userName.value.length >10  ){
                alert('输入的用户名长度不合要求');
                form.userName.focus();
                return false;
            }

            if(/[\"<>\. ]/.test(form.userName.value)){
                alert('您的输入含有不合法字符');
                form.userName.focus();
                return false;
            }

            if( form.password.value.length < 2 || form.password.value.length >10  ){
                alert('输入的密码长度不合要求');
                form.password.focus();
                return false;
            }

        };
};