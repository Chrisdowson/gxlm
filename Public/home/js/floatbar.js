/**
 * Created by chrisdowson.duan on 15-12-9.
 */
$("#feedback").click(function(){
    content = $("#content").val();
    $.ajax({
        url:'../user/feedback.html',
        type:'post',
        data:{
            content:content
        },
        success:function(data){
            if(data.success=='1'){
                alert('反馈成功');
                location.reload();
            }else{
                alert(data.msg);
            }
        }
    })
})