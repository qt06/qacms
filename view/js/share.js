//********************************************************************************
//** 一键转载
//********************************************************************************
var sc=document.getElementsByTagName('script');
var src=sc[sc.length-1].src;
var imgfolder=src.substring(src.indexOf('=')+1);
var title=encodeURIComponent(document.title);
var uri=encodeURIComponent(document.location.href);
document.writeln("<a href=\"javascript:void(0);\" onclick=\"qqWb();\" title=\"分享到腾讯微博\" ><img src=\"http://t.qq.com/favicon.ico\" alt=\"分享到腾讯微博\" border=\"0\"><\/a> ");
function qqWb(){
	var _t = encodeURI(document.title);
	var _url = encodeURI(window.location);
	var _source = 1000000;
	var _site = encodeURI('http://www.viold.com/');
	var _pic = '';
	var _u = 'http://v.t.qq.com/share/share.php?title='+_t+'&url='+_url+'&source='+_source+'&site='+_site+'&pic='+_pic;
	window.open(_u,'分享到腾讯微博', 'width=620, height=450, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no');
}
document.writeln("<a href=\"javascript:void((function(s,d,e){try{}catch(e){}var f='http:\/\/v.t.sina.com.cn\/share\/share.php?',u=d.location.href,p=['url=',e(u),'&title=',e(d.title),'&appkey=1415948982'].join('');function a(){if(!window.open([f,p].join(''),'mb',['toolbar=0,status=0,resizable=1,width=620,height=450,,',].join('')))u.href=[f,p].join('');};if(\/Firefox\/.test(navigator.userAgent)){setTimeout(a,0)}else{a()}})(screen,document,encodeURIComponent));\" title=\"分享到新浪微博\"><img src=\"http://t.sina.com.cn/favicon.ico\" alt=\"分享到新浪微博\" border=\"0\"><\/a> ");
document.writeln("<a href=\"javascript:(function(){window.open(\'http://t.163.com/article/user/checkLogin.do?link=http://news.163.com/&source=\'+\'www.viold.com\'+ \'&info=\'+encodeURIComponent(document.title)+\' \'+encodeURIComponent(location.href),\'_blank\',\'width=620,height=450\');})()\" title=\"分享到网易微博\"><img src=\"http://t.163.com/favicon.ico\" alt=\"分享到网易微博\" border=\"0\"></a> ");
document.write('<a href="javascript:window.open(\'http://www.google.com/bookmarks/mark?op=add&amp;bkmk=\'+ uri +\'&amp;title=\'+ title,\'_blank\',\'width=900,height=700\');void(0)\" title=\"分享到Google书签\" ><img src=\"http://www.google.com/favicon.ico\" alt=\"分享到Google书签\" border=\"0\"></a> ')
document.write('<a href="javascript:window.open(\'http://cang.baidu.com/do/add?it=\'+ title +\'&iu=\'+ uri +\'&fr=ien#nw=1\',\'_blank\',\'scrollbars=no,width=620,height=450,status=no,resizable=yes\'); void 0" title=\"分享到百度收藏\"><img src=\"http://www.baidu.com/favicon.ico\" alt=\"分享到百度收藏\" border=\"0\"></a> ')
document.write('<a href="javascript:void((function(s,d,e){if(/renren\.com/.test(d.location))return;var f=\'http://share.renren.com/share/buttonshare?link=\',u=d.location,l=d.title,p=[e(u),\'&title=\',e(l)].join(\'\');function%20a(){if(!window.open([f,p].join(\'\'),\'xnshare\',[\'toolbar=0,status=0,resizable=1,width=626,height=436,left=\',(s.width-626)/2,\',top=\',(s.height-436)/2].join(\'\')))u.href=[f,p].join(\'\');};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else%20a();})(screen,document,encodeURIComponent));" title="分享到人人网"><img src=\"http://s.xnimg.cn/favicon-rr.ico\" alt=\"分享到人人网\" border=\"0\"></a> ')
document.write('<a href="javascript:d=document;t=d.selection?(d.selection.type!=\'None\'?d.selection.createRange().text:\'\'):(d.getSelection?d.getSelection():\'\');void(kaixin=window.open(\'http://www.kaixin001.com\/~repaste\/repaste.php?&amp;rurl=\'+ uri +\'&amp;rtitle=\'+ title +\'&amp;rcontent=\'+ title,width=620,height=450,\'kaixin\'));kaixin.focus();\" title=\"分享到开心网\"><img src=\"http://img1.kaixin001.com.cn/i/favicon.ico" alt=\"分享到开心网\" border=\"0\"></a> ')
document.write('<a href="javascript:void(function(){var d=document,e=encodeURIComponent,s1=window.getSelection,s2=d.getSelection,s3=d.selection,s=s1?s1():s2?s2():s3?s3.createRange().text:\'\',r=\'http://www.douban.com/recommend/?url=\'+ uri +\'&title=\'+ title +\'&sel=\'+e(s)+\'&v=1\',x=function(){if(!window.open(r,\'douban\',\'toolbar=0,resizable=1,scrollbars=yes,status=1,width=450,height=330\'))location.href=r+\'&r=1\'};if(/Firefox/.test(navigator.userAgent)){setTimeout(x,0)}else{x()}})()" title=\"分享到豆瓣\"><img src=\"http://img3.douban.com/favicon.ico" alt=\"分享到豆瓣\" border=\"0\"></a> ')
