/**
 * Created by chrisdowson.duan on 15-12-7.
 */
$("#addRowRaiseScale").click(function(){
    var len = $(this).parent('.controls').find('input').length;
    $(this).before('<br><br><input type="text" class="span2 options" id="options" name="options['+len+']" data-provide="options">');
})