//图片效果
(function(a){a.fn.lazyload=function(b){var c={threshold:0,failurelimit:0,event:"scroll",effect:"show",container:window};if(b){a.extend(c,b)}var d=this;if("scroll"==c.event){a(c.container).bind("scroll",function(g){var e=0;d.each(function(){if(a.abovethetop(this,c)||a.leftofbegin(this,c)){}else{if(!a.belowthefold(this,c)&&!a.rightoffold(this,c)){a(this).trigger("appear")}else{if(e++>c.failurelimit){return false}}}});var f=a.grep(d,function(h){return!h.loaded});d=a(f)})}this.each(function(){var e=this;if(undefined==a(e).attr("original")){a(e).attr("original",a(e).attr("src"))}if("scroll"!=c.event||undefined==a(e).attr("src")||c.placeholder==a(e).attr("src")||(a.abovethetop(e,c)||a.leftofbegin(e,c)||a.belowthefold(e,c)||a.rightoffold(e,c))){if(c.placeholder){a(e).attr("src",c.placeholder)}else{a(e).removeAttr("src")}e.loaded=false}else{e.loaded=true}a(e).one("appear",function(){if(!this.loaded){a("<img />").bind("load",function(){a(e).hide().attr("src",a(e).attr("original"))[c.effect](c.effectspeed);e.loaded=true}).attr("src",a(e).attr("original"))}});if("scroll"!=c.event){a(e).bind(c.event,function(f){if(!e.loaded){a(e).trigger("appear")}})}});a(c.container).trigger(c.event);return this};a.belowthefold=function(c,d){if(d.container===undefined||d.container===window){var b=a(window).height()+a(window).scrollTop()}else{var b=a(d.container).offset().top+a(d.container).height()}return b<=a(c).offset().top-d.threshold};a.rightoffold=function(c,d){if(d.container===undefined||d.container===window){var b=a(window).width()+a(window).scrollLeft()}else{var b=a(d.container).offset().left+a(d.container).width()}return b<=a(c).offset().left-d.threshold};a.abovethetop=function(c,d){if(d.container===undefined||d.container===window){var b=a(window).scrollTop()}else{var b=a(d.container).offset().top}return b>=a(c).offset().top+d.threshold+a(c).height()};a.leftofbegin=function(c,d){if(d.container===undefined||d.container===window){var b=a(window).scrollLeft()}else{var b=a(d.container).offset().left}return b>=a(c).offset().left+d.threshold+a(c).width()};a.extend(a.expr[":"],{"below-the-fold":"$.belowthefold(a, {threshold : 0, container: window})","above-the-fold":"!$.belowthefold(a, {threshold : 0, container: window})","right-of-fold":"$.rightoffold(a, {threshold : 0, container: window})","left-of-fold":"!$.rightoffold(a, {threshold : 0, container: window})"})})(jQuery);$("img").lazyload({placeholder:"usr/themes/spring/images/grey.gif",effect:"fadeIn"});
//搜索框提示
if ($('#search .input').val() == "") {
    $('#search .input').val('请输入内容搜索！')
}
$('#search .input').focus(function() {
    if ($(this).val() == '请输入内容搜索！') {
        $('#search .input').val('')
    }
});
$('#search .input').blur(function() {
    if ($(this).val() == '') {
        $('#search .input').val('请输入内容搜索！')
    }
});
//链接轻移
$(".entry-title a,.sidelink a").hover(function(){$(this).stop().animate({'marginLeft':"+=5"}, 250);},function(){$(this).stop().animate({'marginLeft':"0"}, 150);});
//链接Loading
$('.entry-title a,.more').click(function(e){
	if(e.which == 5775){
              return true;
        }else{
              $(this).text('页面加载中...');
	      $('#clickload').show();
              window.location = $(this).attr('href');
        }
});
//返回顶部
$('.top').click(function(){$('html,body').animate({scrollTop: '0px'}, 400);return false;});
$(function(){
//隐藏老用户输入框
if($('#author').length>0 && $('#author').val().length>0){
	$('<p id="welcome">欢迎回来<span id="username"></span></p>').insertBefore('#author_info');
	$('#author_info').slideUp();
		
	var ss = $('input[id="author"]').attr("value");
	$('#username').html(" "+ss+"：");
	$('#welcome').append("<span id=\"change\">修改资料<\/span><span id=\"update\">点击这里更新资料<\/span><span id=\"hint\">资料修改成功<\/span")
	$('#change').click(function(){
	$('#author_info').slideDown();
		$(this).hide();
	$('#update').show();
	});
	$('#update').click(function(){
	$('#author_info').slideUp();
		$(this).hide();
	$('#hint').show();
		setTimeout(function(){$('#hint').hide();},2000);
		setTimeout(function(){$('#change').show();},2000);
		var s = $('input[id="author"]').attr("value");
	$('#username').html(" "+s+"：");
	});
	}
})
//文章Tab效果
window.onload = 
function(){
alltabs = document.getElementById('tabs').getElementsByTagName('dl')
for(i = 0; i < alltabs.length; i++){
   alltabs[i].className = "close"
   alltabs[0].className = "open";
   alltabs[i].onmouseover = function(){
    for(j = 0; j < alltabs.length; j++){
     alltabs[j].className = "close"
    }
    this.className = "open"
   }
}
}
