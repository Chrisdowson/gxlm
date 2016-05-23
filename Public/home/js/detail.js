/**
 * Created by chrisdowson.duan on 15-12-19.
 */
$('.center').on('submit', 'form', function (e){
    e.preventDefault();
    var answer_radio = $('form input[name="answer"]:checked ').val();
    var answer_text = $('input[name="answer"]').val()
    if(typeof(answer_radio)=='undefined'&&answer_text==0){
        alert('答案不能为空！');
        return false;
    }
    $(this).ajaxSubmit({
        dataType:'json',
        success:function(data){
            if(data['success']=='0'){
                alert(data['msg']);
            }else{
                window.location.href='?id='+data['msg'];
            }
        }
    })
})