/**
 * Created by chris.duan on 15-12-3.
 */
$("#login").click(function(){
    var username= $('#username').val();
    var password= $('#password').val();
    if(''==username){
        alert('用户名不能为空');
        return false;
    }
    if(''==password){
        alert('密码不能为空');
        return false;
    }
    $.ajax({
        type:"post",
        url:'../user/login.html',
        data:{
            username:username,
            password:password
        },
        success:function(data){
            if('1'==data.success){
                window.location.href="index.html";
            }else{
                if(data.msg){
                    alert(data.msg);
                }else{
                    alert('出错啦！');
                }
            }
        }
    })
});
$("#register").click(function(){
    var username = $('#reg_username').val();
    var password = $('#reg_password').val();
    var repassword = $('#reg_repassword').val();
    if(''==username){
        alert('用户名不能为空');
        return false;
    }
    if(''==password){
        alert('密码不能为空');
        return false;
    }
    if(password!=repassword){
        alert('两次输入的密码不一样，请重新输入');
        return false;
    }
    $.ajax({
        url:'../user/register.html',
        type:'post',
        data:{
            username:username,
            password:password,
            repassword:repassword
        },
        success:function(data){
            if('1'==data.success){
                window.location.href="index.html";
            }else{
                if(data.msg){
                    alert(data.msg);
                }else{
                    alert('出错啦！');
                }
            }
        }
    })
})