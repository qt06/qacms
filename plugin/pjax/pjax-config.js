//pjax
var acci = -1;
var pjaxFocusElementCache = {};
$(document).pjax('.pagination a, [href*=index-index],[href*=thread-index], [href*=forum-index]', '#body', {fragment: "[role='main']", maxCacheLength: 0});
$(document).on('pjax:click', function(e) {
pjaxFocusElementCache[location.href] = document.activeElement;
var players = $('audio'); //"object" === typeof plyr ? plyr.get() : [];
for(var i = 0, len = players.length; i < len; i++) {
players[i].stop();
}
});
$(document).on('pjax:beforeReplace', function(e) {
var players = $('audio').removeAttr('autoplay');
for(var i = 0; i < players.length; i++) {
players.eq(i).stop();
}
});
$(document).on('pjax:end', function(e) {
openFocus();
//removeAccesskeys();
initPlayer();
});
$(window).on('load', function() {
openFocus();
initPlayer();
//removeAccesskeys();
});
function openFocus() {
var focus = null;
if(location.href in pjaxFocusElementCache) {
focus = pjaxFocusElementCache[location.href];
}
//focus = document.body.contains(focus) ? focus : false;
focus = focus ? $('[href="' + focus.href + '"]:last') : null;
//focus[0].focus();

focus = focus ? focus : $('.subject_link, #content');
focus = focus.length > 0 ? focus : $('.message').parent();
focus = focus.length > 0 ? focus : $('input[name=email]');
if(focus.length) {
focus[0].focus();
var of = focus[0];
var index = $('.subject_link, .post').index(of);
acci = index;
} else {
acci = -1;
//document.body.focus();
}
}

function initPlayer() {
if($('embed').length > 0) {
//alert('the embed len is: ' +$('embed').length);
$('embed').replaceWith(function() {
var src = $(this).attr('src');
$(this).attr({"src": "", "play": "false", "autoStart": "false"});
var ph = '<audio controls="controls" autoplay="autoplay" src="' + src + '"></audio>';
return ph;
});

/**
var players = plyr.setup('#content',{
i18n: {
    restart:            "重新播放",
    rewind:             "后退 {seektime} 秒",
    play:               "播放",
    pause:              "暂停",
    forward:            "快进 {seektime} 秒",
    buffered:           "缓冲",
    currentTime:        "当前时长",
    duration:           "持续时间",
    volume:             "音量",
    toggleMute:         "切换静音",
    toggleCaptions:     "切换字幕",
    toggleFullscreen:   "切换全屏"
}
});
*/
//alert('init: ' + players.length);

}
}
