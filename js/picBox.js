function show_selector_menu(select_menu_id){
var select_menu = $(select_menu_id);
if( select_menu.style.visibility == "inherit"){
var menu_content = select_menu.firstChild;
if(navigator.userAgent.indexOf('MSIE')>=0){
menu_content.style.marginBottom = "0";
var select_menu_height = select_menu.offsetHeight;
var timer = setInterval(function(){var marginb = parseInt(menu_content.style.marginBottom);
if( marginb<=parseInt("-"+select_menu_height) ){
menu_content.style.marginBottom = "0";
select_menu.style.visibility = "hidden";
clearInterval(timer);	
}else{menu_content.style.marginBottom = (marginb-20)+"px";}},1);}else{
			select_menu.style.visibility = "hidden";}}else{
		var menu_content = select_menu.firstChild;
		if(navigator.userAgent.indexOf('MSIE')>=0){
			menu_content.style.marginBottom = "-"+ select_menu.offsetHeight+"px";
			var timer = setInterval(function(){var marginb = parseInt(menu_content.style.marginBottom);
									if(marginb>=0){menu_content.style.marginBottom = "0";
									clearInterval(timer);}else{menu_content.style.marginBottom = (marginb+20)+"px";}},1);}
		selector_is_clicked[select_menu_id] = true;select_menu.style.visibility = "inherit";}
}
var showImageIndex = -1;
var imageTimer;
function showImage(imageIndex){
	var flash_img_div = document.getElementById("flash_img");
	var flash_title = document.getElementById("flash_title");
	var flash_abs = document.getElementById("flash_abs");
	if(imageIndex>fImgs.length-1){imageIndex = 0;}
	if(!fImgs[imageIndex] || imageIndex==showImageIndex) return false;	
	var imgId = "__fImg"+imageIndex;
	flash_img_div.filters && flash_img_div.filters[0].Apply();
	for(i=0; i<flash_img_div.childNodes.length; i++){
		flash_img_div.childNodes[i].style.display = "none";
	}
	if( document.getElementById(imgId) ){
		var imga = document.getElementById(imgId);
		imga.style.display = "block";
		if(imga.tagName=="OBJECT"){
			imga.rewind();
			imga.Play();
		}
	}else{
		var pos = fImgsrc[imageIndex].src.lastIndexOf(".");
		if( fImgsrc[imageIndex].src.substr(pos+1).substr(0,3).toLowerCase()=="swf" ){
			flash_img_div.innerHTML += '\
				<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="320" height="240" id="'+imgId+'">\
					<param name="movie" value="'+fImgsrc[imageIndex].src+'" />\
					<param name="quality" value="high" />\
					<embed src="'+fImgsrc[imageIndex].src+'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="320" height="240"></embed>\
				</object>';

		}else{
			var img = new Image();
			img.src = fImgsrc[imageIndex].src;
			imgalt=fImgsrc[imageIndex].alt;
			imgsizes=imgalt.split("*");
			img.width = imgsizes[0];
			img.height = imgsizes[1];
			var a = document.createElement("a");
			a.href = fImgs[imageIndex].href;
			a.target = "_blank";
			a.id = imgId;
			a.appendChild(img);
			flash_img_div.appendChild(a);
		}
	}
	flash_img_div.filters && flash_img_div.filters[0].Play();
	var flash_show_ctl_msg = document.getElementById("flash_show_ctl_msg");
	flash_show_ctl_msg.filters && flash_show_ctl_msg.filters[0].Apply();
	flash_title.href = fImgs[imageIndex].href;
	flash_title.innerHTML = fImgs[imageIndex].title;
	flash_abs.innerHTML = fImgs[imageIndex].firstChild.title;
	flash_show_ctl_msg.filters && flash_show_ctl_msg.filters[0].Play();
	showImageIndex = imageIndex;
	return true;
}
function imagePlay(){
	if(imageTimer) return;
	if(showImageIndex>=fImgs.length-1){	showImageIndex = -1;}
	showImage(showImageIndex+1);
	imageTimer = setInterval(function(){var stat = showImage(showImageIndex+1);if(!stat){stop();}},7000);
}
function stop(){clearInterval(imageTimer);	imageTimer = null;}
function showNextImage(){showImage(showImageIndex+1);}
function showPrevImage(){showImage(showImageIndex-1);}

function changeTab(num){
var menus=$("#TabMenu li");
var tabs=$("#txt_tab div");
for(i=0;i<3;i++){var m_nums=i*2;menus[m_nums].className="tab_off";}
for(n=0;n<tabs.length;n++){tabs[n].style.display="none";}
var sn=num*2;menus[sn].className="tab_on";tabs[num].style.display="block";
}