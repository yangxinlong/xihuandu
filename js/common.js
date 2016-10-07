var userAgent = navigator.userAgent.toLowerCase();
var is_webtv = userAgent.indexOf('webtv') != -1;
var is_kon = userAgent.indexOf('konqueror') != -1;
var is_mac = userAgent.indexOf('mac') != -1;
var is_saf = userAgent.indexOf('applewebkit') != -1 || navigator.vendor == 'Apple Computer, Inc.';
var is_opera = userAgent.indexOf('opera') != -1 && opera.version();
var is_moz = (navigator.product == 'Gecko' && !is_saf) && userAgent.substr(userAgent.indexOf('firefox') + 8, 3);
var is_ns = userAgent.indexOf('compatible') == -1 && userAgent.indexOf('mozilla') != -1 && !is_opera && !is_webtv && !is_saf;
var is_ie = (userAgent.indexOf('msie') != -1 && !is_opera && !is_saf && !is_webtv) && userAgent.substr(userAgent.indexOf('msie') + 5, 3);
function redirect(url) {
	window.location.replace(url);
}
function getcookie(name) {
	var cookie_start = document.cookie.indexOf(name);
	var cookie_end = document.cookie.indexOf(";", cookie_start);
	return cookie_start == -1 ? '' : unescape(document.cookie.substring(cookie_start + name.length + 1, (cookie_end > cookie_start ? cookie_end : document.cookie.length)));
}
function setcookie(cookieName, cookieValue, seconds, path, domain, secure) {
	var expires = new Date();
	expires.setTime(expires.getTime() + seconds);
	document.cookie = escape(cookieName) + '=' + escape(cookieValue)
		+ (expires ? '; expires=' + expires.toGMTString() : '')
		+ (path ? '; path=' + path : '/')
		+ (domain ? '; domain=' + domain : '')
		+ (secure ? '; secure' : '');
}
function $(id) {
	return document.getElementById(id);
}
function in_array(needle, haystack) {
	if(typeof needle == 'string') {
		for(var i in haystack) {
			if(haystack[i] == needle) {
					return true;
			}
		}
	}
	return false;
}
function arraypush(a, value) {
	a[a.length] = value;
	return a.length;
}
function trim(str) {
	return str.replace(/(\s+)$/g, '').replace(/^\s+/g, '');
}
function parseurl(str, mode) {
	str = str.replace(/([^>=\]"'\/]|^)((((https?|ftp):\/\/)|www\.)([\w\-]+\.)*[\w\-\u4e00-\u9fa5]+\.([\.a-zA-Z0-9]+|\u4E2D\u56FD|\u7F51\u7EDC|\u516C\u53F8)((\?|\/|:)+[\w\.\/=\?%\-&~`@':+!]*)+\.(jpg|gif|png|bmp))/ig, mode == 'html' ? '$1<img src="$2" border="0">' : '$1[img]$2[/img]');
	str = str.replace(/([^>=\]"'\/]|^)((((https?|ftp|gopher|news|telnet|rtsp|mms|callto|bctp|ed2k):\/\/)|www\.)([\w\-]+\.)*[\w\-\u4e00-\u9fa5]+\.([\.a-zA-Z0-9]+|\u4E2D\u56FD|\u7F51\u7EDC|\u516C\u53F8)((\?|\/|:)+[\w\.\/=\?%\-&~`@':+!#]*)*)/ig, mode == 'html' ? '$1<a href="$2" target="_blank">$2</a>' : '$1[url]$2[/url]');
	str = str.replace(/([^\w>=\]:"']|^)(([\-\.\w]+@[\.\-\w]+(\.\w+)+))/ig, mode == 'html' ? '$1<a href="mailto:$2">$2</a>' : '$1[email]$2[/email]');
	return str;
}

function isUndefined(variable) {
	return typeof variable == 'undefined' ? true : false;
}
function findtags(parentobj, tag) {
	if(!isUndefined(parentobj.getElementsByTagName)) {
		return parentobj.getElementsByTagName(tag);
	} else if(parentobj.all && parentobj.all.tags) {
		return parentobj.all.tags(tag);
	} else {
		return null;
	}
}
function alterview(tname){
	if($(tname)!=null){
		if($(tname).style.display=='none'){
			$(tname).style.display='';
		}else{
			$(tname).style.display='none';
		}
	}
}
function setTab(area,id) {
	var tabArea=$(area);
	var contents=tabArea.childNodes;
	for(i=0; i<contents.length; i++) {
		if(contents[i].className=='tabcurrent'){contents[i].style.display='none';}
	}
	$(id).style.display='';
	var tabs=$(area+'tabs').getElementsByTagName('a');
	for(i=0; i<tabs.length; i++) { tabs[i].className='tab'; }
	$(id+'tab').className='tab curtab';
	$(id+'tab').blur();
}
function alt_font(id,size){
	$(id).style.fontSize = size + 'px';
	var tags=$(id).childNodes;
	for(i=0;i<tags.length;i++){
		tags[i].style.fontSize=size+"px";
		}
}

function input_over(i_id){
	i_id.style.backgroundColor="#FDF9EE";i_id.style.border="1px solid #ff6600";
	}
function input_out(i_id){
	i_id.style.backgroundColor="#fff";i_id.style.border="1px solid #DBCA9F";
	}	
	
	