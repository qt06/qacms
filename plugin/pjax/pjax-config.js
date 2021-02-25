function isIE() {
return (!!window.ActiveXObject || "ActiveXObject" in window);
}
function openFocus() {
var focus = [];
var fec = Storages.cookieStorage.get('pjaxfec');
focus = focus.length > 0 ? focus : $('.message').parent();
focus = focus.length > 0 ? focus : $('[href="'+ pjaxfec + '"]:last');
focus = focus.length > 0 ? focus : $('input[name=cid]');
focus = focus.length > 0 ? focus : $('input[name=message]');
focus = focus.length > 0 ? focus : $('input[name=email]');
focus = focus.length > 0 ? focus : $('input[name=username]');
focus = focus.length > 0 ? focus : $('[href*=luck]');
if(focus.length > 0) {
if(focus[0].tagName == 'DIV') {
focus.attr('tabindex','-1');
}
focus[0].focus();
}
}

function initPlayer() {
if($('embed').length > 0) {
//alert('the len is: ' +$('embed').length);
$('embed').replaceWith(function() {
var src = $(this).attr('src');
$(this).attr({"src": "", "play": "false", "autoStart": "false"});
var ph = '<audio controls="controls" src="' + src + '"></audio>';
return ph;
});
}
}
function bgs() {
//var audio = new Audio("http://www.qt.hk/view/bgs.mp3"); //声音文件地址，支持mp3 或者 ogg
//audio.volume = 0.2; //音量，取值范围 0.1 到 1.0
//audio.play();
}

function loadedFunction() {
bgs();
openFocus();
initPlayer();
if (!isIE()) {
  let keys = [];
  document.querySelectorAll('[accesskey]').forEach(function(el) {
    let key = el.getAttribute('accesskey');
    if (!keys.includes(key)) {
      keys.push(key);
    }
  });
  keys.forEach(function(key) {
    $('[accesskey="' + key + '"]').addClass('accesskey-' + key);
  });
		$('[accesskey]').removeAttr('accesskey');
}
}
$(window).on('load', function() {
loadedFunction();
});
//pjax
var pjaxfec = '';
var pjax = new Pjax({
elements: '[href*=index-index], [href*="forum-index"], [href*="thread-index"]',
selectors: ["title", "#body"],
cacheBust: false,
scrollTo: false,
scrollrestoration: false
});
$(document).on('pjax:send', function(e) {
var ae = document.activeElement;
if(ae != null && ae.href != null) {
pjaxfec = ae.href;
Storages.cookieStorage.set('pjaxfec', ae.href);
}
});
$(document).on('pjax:success', function(e) {
loadedFunction();
});


