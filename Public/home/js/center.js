/**
 * Created by chrisdowson.duan on 15-12-18.
 */
$('#birth_year,#birth_month,#birth_date').click(function(){
    if($(this).hasClass('active')){
        $(this).removeClass('active');
    }else{
        $(this).addClass('active');
    }
});
$('#birth_year li,#birth_month li, #birth_date li').click(function(){
    var val = $(this).html();
    $(this).parent('ul').parent('.cmd_con').parent('.cmd_wrap').find('.cmd_btn span').html(val);
});
// 头像上传
$(".head-upload-form").on("submit", function(event) {
    event.preventDefault();
    var that = $(this);
    file = that.find("input[name='file']");
    if (!file.val())
        return false;
    var ext = [".jpg", ".jpeg", ".png", ".gif", ".bmp"];
    var filepath = file.val();
    var pos = filepath.lastIndexOf('.');
    var fileExt = filepath.substring(pos).toLowerCase();
    var flag = false;
    for (var i=0, len=ext.length; i<len; i++) {
        if (fileExt == ext[i]) {
            flag = true;
            break;
        }
    }
    if (!flag) {
        var n = noty({
            text:"抱歉哟！<br />目前只支持上传.jpg、.jpeg、.png、.gif、.bmp格式图片",
            layout:"center",
            type:"alert",
            timeout:2000,
            animateOpen: {opacity: "show"}
        });
//        Pop.message('file-error','error','抱歉哟！<br />目前只支持上传.jpg、.jpeg、.png、.gif、.bmp格式图片', {width: 576});
        return false;
    }
    try{
        //判断文件上传大小 1M 以内 非IE
        if(navigator.userAgent.indexOf('MSIE') < 0){
            var maxFileSize = 1024*1024;
            var fileSize = file.get(0).files[0].size;
            if(fileSize > maxFileSize){
                file.val('');
                var n = noty({
                    "text":"上传文件限制在1M以内!",
                    "layout":"center",
                    "type":"alert",
                    "animateOpen": {"opacity": "show"}
                });
//                Pop.message('error','error','上传文件限制在1M以内!');
                return false;
            }
        }
    }catch(e){}

    that.ajaxSubmit({
        dataType: 'json',
        success: function(data) {
            if (data['success'] == 1) {
                //待图片加载完成之后再显示
                var _img = new Image();
                _img.src = data["path"];
                _img.onload = _img.onerror = function(){
                    var img = $('#head_img');
                    img.attr("src", data["path"]);
                    $('#input_head').val(data["path"]);
                    $('#left_nick_img').attr("src", data["path"]);
                };
            } else {
                file.val('');
                var n = noty({
                    "text":data[1],
                    "layout":"center",
                    "type":"alert",
                    "animateOpen": {"opacity": "show"}
                });
//                Pop.message('error','error',data[1]);
            }
        }
    });
});