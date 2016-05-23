function resizebg() {
  var cw = $(window).width(),
      ch = $(window).height(),
    iw = $(".bg_img").width(),
    ih = $(".bg_img").height();

if(cw / ch > iw / ih) {
var new_h = cw * ih / iw,
imgTop = (ch - new_h) / 2;

$('.bg_img').css( {
    'width':cw+'px',
    'height':new_h+'px',
    'top':imgTop + "px",
    'left':''
  } );
} else {
var new_w = ch * iw / ih,
imgLeft = (cw - new_w) / 2;

  $('.bg_img').css( {
    'width':new_w+'px',
    'height':ch+'px',
    'left':imgLeft + "px",
    'top':''
  } );
 }
 }

function wait() {
var cw = $(window).width(),
      ch = $(window).height(),
    iw = $(".wait").width(),
    ih = $(".wait").height();

  $(".wait").css({'left':((cw-iw)/3)+'px','top':((ch-ih)/2)+'px'});
 }


jQuery.cookie = function(name, value, options) {
     if (typeof value != 'undefined') { // name and value given, set cookie
         options = options || {};
      if (value === null) {
             value = '';
             options.expires = -1;
         }
         var expires = '';
         if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
             var date;
             if (typeof options.expires == 'number') {
                 date = new Date();
                 date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
             } else {
                 date = options.expires;
             }
             expires = '; expires=' + date.toUTCString();
         }
         var path = options.path ? '; path=' + (options.path) : '';
         var domain = options.domain ? '; domain=' + (options.domain) : '';
         var secure = options.secure ? '; secure' : '';
         document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
     } else {
         var cookieValue = null;
         if (document.cookie && document.cookie != '') {
             var cookies = document.cookie.split(';');
             for (var i = 0; i < cookies.length; i++) {
                 var cookie = jQuery.trim(cookies[i]);
                 if (cookie.substring(0, name.length + 1) == (name + '=')) {
                     cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                     break;
                 }
             }
         }
         return cookieValue;
     }
 };

