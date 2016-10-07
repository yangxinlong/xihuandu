var image_num = 0;
var file_num = 0;
var media_num = 0;
var flash_num = 0;
var moduleid = 0;
var smanager_id = 1;
var smanager_fieldname = '';
var smanager_filetype = '';

function severmanager(fieldname,id,filetype){
	smanager_filetype = filetype;
	if(filetype == 'singleimage') filetype = 'image';
	if(filetype == 'singleflash') filetype = 'flash';
	if(filetype == 'singlefile') filetype = 'file';
	if(filetype == 'singlemedia') filetype = 'media';
	smanager_fieldname = fieldname;
	smanager_id = id;
	if(is_ie){
		var posLeft = window.event.clientX-100;
		var posTop = window.event.clientY; 
	}
	else{
		var posLeft = 100;
		var posTop = 100;
	}
	window.open("./include/filemanager/browser.html?Type=" + filetype + "&Connector=connector.php", "FileManagerWin", "scrollbars=yes,resizable=yes,statebar=no,width=600,height=400,left=" + posLeft + ", top=" + posTop);
}

function seturl(url)
{
	if(smanager_filetype == 'singleimage' || smanager_filetype == 'singleflash' || smanager_filetype == 'singlefile' || smanager_filetype == 'singlemedia'){
		var filetype = smanager_filetype;
		if(filetype == 'singleimage') filetype = 'image';
		if(filetype == 'singleflash') filetype = 'flash';
		if(filetype == 'singlefile') filetype = 'file';
		if(filetype == 'singlemedia') filetype = 'media';
		$(smanager_fieldname + 'remote').value = url;
		checksingle(smanager_fieldname,filetype);
	}else{
		$(smanager_fieldname + '[remote][' + smanager_id + ']').value = url;
		insertmodule(smanager_fieldname,smanager_id,smanager_filetype);
	}
}
function deloldfile(fieldname,id,mode) {
	$('old' + fieldname + id).outerHTML = '';
	if(mode == 'image'){
		image_num --;
		if(image_num == image_limit - 1) addmodule(fieldname,mode);
	}
	if(mode == 'file'){
		file_num --;
		if(file_num == file_limit - 1) addmodule(fieldname,mode);
	}
	if(mode == 'media'){
		media_num --;
		if(media_num == media_limit - 1) addmodule(fieldname,mode);
	}
	if(mode == 'flash'){
		flash_num --;
		if(flash_num == flash_limit - 1) addmodule(fieldname,mode);
	}
}
function delmodule(fieldname,id,mode) {
	if(mode == 'image'){
		$('new' + fieldname).removeChild($(fieldname + 'local' + id).parentNode.parentNode.parentNode.parentNode);
		image_num --;
		if(image_num == image_limit - 1) addmodule(fieldname,mode);
	}
	if(mode == 'file'){
		$('new' + fieldname).removeChild($(fieldname + 'local' + id).parentNode.parentNode.parentNode);
		file_num --;
		if(file_num == file_limit - 1) addmodule(fieldname,mode);
	}
	if(mode == 'media'){
		$('new' + fieldname).removeChild($(fieldname + 'local' + id).parentNode.parentNode.parentNode);
		media_num --;
		if(media_num == media_limit - 1) addmodule(fieldname,mode);
	}
	if(mode == 'flash'){
		$('new' + fieldname).removeChild($(fieldname + 'local' + id).parentNode.parentNode.parentNode);
		flash_num --;
		if(flash_num == flash_limit - 1) addmodule(fieldname,mode);
	}
}
function uploadmode(fieldname,id){
	if($(fieldname + 'local' + id).style.display == ''){
		$(fieldname + 'local' + id).style.display = 'none';
		$(fieldname + '[remote][' + id + ']').style.display = '';
		$(fieldname + 'select' + id).style.display = '';
	}else{
		$(fieldname + '[remote][' + id + ']').style.display = 'none';
		$(fieldname + 'select' + id).style.display = 'none';
		$(fieldname + 'local' + id).style.display = '';
	}
}

function addmodule(fieldname,umode){
	if(umode == 'image' && image_num >= image_limit) return;
	if(umode == 'file' && file_num >= file_limit) return;
	if(umode == 'media' && media_num >= media_limit) return;
	if(umode == 'flash' && flash_num >= flash_limit) return;
	var id = moduleid;
	var newnode = $('add' + fieldname).firstChild.cloneNode(true);
	var tags;
	tags = newnode.getElementsByTagName('input');
	for(i in tags) {
		if(tags[i].name == fieldname + 'mode') {
			tags[i].id = tags[i].name += id;
			tags[i].onclick = function(){uploadmode(fieldname,id)};
		}
		if(tags[i].name == fieldname + 'local') {
			tags[i].id = tags[i].name += id;
			tags[i].onchange = function(){insertmodule(fieldname,id,umode)};
			tags[i].unselectable = 'on';
		}
		if(tags[i].name == fieldname + 'remote') {
			tags[i].id = tags[i].name = fieldname + '[remote][' + id + ']';
			tags[i].onchange = function(){insertmodule(fieldname,id,umode)};
		}
		if(tags[i].name == fieldname + 'select') {
			tags[i].id = tags[i].name += id;
			tags[i].onclick = function(){severmanager(fieldname,id,umode)};
		}
		if(tags[i].name == fieldname + 'title') {
			tags[i].id = tags[i].name = fieldname + '[title][' + id + ']';
		}
	}
	tags = newnode.getElementsByTagName('select');
	for(i in tags) {
		if(tags[i].name == fieldname + 'player') {
			tags[i].id = tags[i].name = fieldname + '[player][' + id + ']';
		}
	}
	tags = newnode.getElementsByTagName('img');
	for(i in tags) {
		if(tags[i].id == fieldname + 'view') {
			tags[i].id += id;
		}
	}
	tags = newnode.getElementsByTagName('span');
	for(i in tags) {
		tags[i].id += id;
	}
	$('new' + fieldname).appendChild(newnode);
	moduleid ++;
}

function openview(fieldname){
	if($('view' + fieldname)!=null){
		if(is_ie && ($('view' + fieldname).style.display=='none')){
			$('view' + fieldname).style.display='';
			$('openview' + fieldname).innerHTML ='<img src="./images/admina/pv_close.gif" title="关闭">';
			var imagevalue = '';
			if($(fieldname + 'local').style.display == ''){
				imagevalue = $(fieldname + 'local').value;
			}else{
				imagevalue = $(fieldname + 'remote').value;
			}
			singleview(imagevalue,fieldname);
		}else{
			$('view' + fieldname).style.display='none';
			$('openview' + fieldname).innerHTML ='<img src="./images/admina/pv_open.gif" title="预览">';
		}
	}
}

function imageview(imagevalue,fieldname,id){
	$(fieldname + '_hidden').filters.item("DXImageTransform.Microsoft.AlphaImageLoader").sizingMethod = 'image';
	try {
		$(fieldname + '_hidden').filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imagevalue;
	} catch (e) {
		alert('无效的图片文件。');
	return;
	}
	var wh = {'w' : $(fieldname + '_hidden').offsetWidth, 'h' : $(fieldname + '_hidden').offsetHeight};
	if(wh['w'] >= viewwidth || wh['h'] >= viewheight) {
		wh = thumbimg(wh['w'], wh['h']);
	}

	if (imagevalue != "" ){
		$(fieldname + 'view' + id).src = imagevalue; 
		$(fieldname + 'view' + id).width = wh['w']; 
		$(fieldname + 'view' + id).height = wh['h'];
	}else{
		$(fieldname + 'view' + id).src = "./images/admina/pview.gif";
	}
}
function singlemode(fieldname,mode){
	var imagevalue = '';
	if($(fieldname + 'local').style.display == ''){
		$(fieldname + 'local').style.display = 'none';
		$(fieldname + 'remote').style.display = '';
		$(fieldname + 'select').style.display = '';
		if(mode == 'image') imagevalue = $(fieldname + 'remote').value;
	}else{
		$(fieldname + 'remote').style.display = 'none';
		$(fieldname + 'select').style.display = 'none';
		$(fieldname + 'local').style.display = '';
		if(mode == 'image') imagevalue = $(fieldname + 'local').value;
	}
	if(mode == 'image' && is_ie && ($('view' + fieldname).style.display == '')) singleview(imagevalue,fieldname);
}

function singleview(imagevalue,fieldname){
	if(!imagevalue){
		$(fieldname + 'view').src = "./images/admina/pview.gif";
		return;
	}
	$(fieldname + '_hidden').filters.item("DXImageTransform.Microsoft.AlphaImageLoader").sizingMethod = 'image';
	try {
		$(fieldname + '_hidden').filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imagevalue;
	} catch (e) {
		alert('无效的图片文件。');
	return;
	}
	var wh = {'w' : $(fieldname + '_hidden').offsetWidth, 'h' : $(fieldname + '_hidden').offsetHeight};
	if(wh['w'] >= viewwidth || wh['h'] >= viewheight) {
		wh = thumbimg(wh['w'], wh['h']);
	}

	$(fieldname + 'view').src = imagevalue; 
	$(fieldname + 'view').width = wh['w']; 
	$(fieldname + 'view').height = wh['h'];
}

function thumbimg(w, h) {
	var x_ratio = viewwidth / w;
	var y_ratio = viewheight / h;
	var wh = new Array();

	if((x_ratio * h) < viewheight) {
		wh['h'] = Math.ceil(x_ratio * h);
		wh['w'] = viewwidth;
	} else {
		wh['w'] = Math.ceil(y_ratio * w);
		wh['h'] = viewheight;
	}
	return wh;
}
function checksingle(fieldname,mode){
	var mvalue = '';
	var extensions = '';
	if($(fieldname + 'local').style.display == ''){
		mvalue = $(fieldname + 'local').value;
	}else{
		mvalue = $(fieldname + 'remote').value;
	}
	if(mvalue == '') {
		return;
	}
	if(mode == 'image') extensions = image_extensions;
	if(mode == 'file') extensions = file_extensions;
	if(mode == 'flash') extensions = flash_extensions;
	if(mode == 'media') extensions = media_extensions;

	var ext = mvalue.lastIndexOf('.') == -1 ? '' : mvalue.substr(mvalue.lastIndexOf('.') + 1, mvalue.length).toLowerCase();
	var re = new RegExp("(^|\\s|,)" + ext + "($|\\s|,)", "ig");
	if(extensions != '' && (re.exec(extensions) == null || ext == '')) {
		if($(fieldname + 'local').style.display == ''){
			$(fieldname + 'local').outerHTML = '<input type="file" size="30" id="' + fieldname + 'local" name="' + fieldname + 'local" style="display:" unselectable="on" onchange="checksingle(\'' + fieldname + '\',\'' + mode + '\')">';
			$(fieldname + 'local').value = '';
		}else{
			$(fieldname + 'remote').outerHTML = '<input type="text" size="30" id="' + fieldname + 'remote" name="' + fieldname + 'remote" style="display:" onchange="checksingle(\'' + fieldname + '\',\'' + mode + '\')">';
			$(fieldname + 'remote').value = '';
		}
		alert('不支持上传此类扩展名的附件!');
	}else{
		if(mode == 'image' && is_ie) singleview(mvalue,fieldname);
	}
}
function clearmodule(fieldname,id,mode){
	if($(fieldname + 'mode' + id).checked){
		$(fieldname + 'local' + id).style.display = '';
		$(fieldname + 'local' + id).outerHTML = '<input type="file" size="30" id="' + fieldname + 'local' + id + '" name="' + fieldname + 'local' + id + '" style="display:" unselectable="on" onchange="insertmodule(\'' + fieldname + '\',\'' + id +'\',\'' + mode + '\')">';
	}else{
		$(fieldname + '[remote][' + id + ']').style.display = '';
		$(fieldname + 'select' + id).style.display = '';
		$(fieldname + '[remote][' + id + ']').value = '';
	}
}
function insertmodule(fieldname,id,mode){
	var mvalue = '';
	var extensions ='';
	if($(fieldname + 'local' + id).style.display == ''){
		mvalue = $(fieldname + 'local' + id).value;
		$(fieldname + 'local' + id).style.display = 'none';
	}else{
		mvalue = $(fieldname + '[remote][' + id + ']').value;
		$(fieldname + '[remote][' + id + ']').style.display = 'none';
		$(fieldname + 'select' + id).style.display = 'none';
	}
	if(mvalue == '') return;
	if(mode == 'image') extensions = image_extensions;
	if(mode == 'file') extensions = file_extensions;
	if(mode == 'media') extensions = media_extensions;
	if(mode == 'flash') extensions = flash_extensions;
	var ext = mvalue.lastIndexOf('.') == -1 ? '' : mvalue.substr(mvalue.lastIndexOf('.') + 1, mvalue.length).toLowerCase();
	var re = new RegExp("(^|\\s|,)" + ext + "($|\\s|,)", "ig");
	if(extensions != '' && (re.exec(extensions) == null || ext == '')) {
		alert('不支持上传此类扩展名的附件!');
		clearmodule(fieldname,id,mode);
	}else{
		$(fieldname + 'mode' + id).style.display = 'none';
		$(fieldname + 'name' + id).innerHTML = mvalue;
		$(fieldname + 'edit' + id).innerHTML = '<a href="#del'+id+'" onclick="delmodule(\'' + fieldname + '\',\'' + id +'\',\'' + mode + '\')">[删除]</a>';
		if(mode == 'image' && is_ie) imageview(mvalue,fieldname,id);
		if(mode == 'image') image_num ++;
		if(mode == 'file') file_num ++;
		if(mode == 'media') media_num ++;
		if(mode == 'flash') flash_num ++;
		addmodule(fieldname,mode);
	}
}
