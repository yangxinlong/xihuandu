function $id(id){
	return document.getElementById(id);
}
function sh_select(obid,oldvalue){
	var obj = $id(obid);
	if(oldvalue === '') return;
	for(var i = 0;i < obj.options.length;i ++){
		if(obj.options[i].value === oldvalue){
			obj.options[i].selected = true;
			return;
		}
    }
}
function sh_mselect(obid,oldvalue){
	var obj = $id(obid);
	if(oldvalue === '') return;
	for(var i = 0;i < obj.options.length;i ++){
		var re = new RegExp("(^|\\t)" + obj.options[i].value + "($|\\t)","ig");
		if(re.exec(oldvalue) != null){
			obj.options[i].selected = true;
		}
    }
	return;
}
function sh_radio(obid,oldvalue){
	var obj = document.getElementsByName(obid);
	if(oldvalue === '') return;
	for(var i = 0;i < obj.length;i ++){
		if(obj[i].value === oldvalue){
			obj[i].checked = true;
			return;
		}
    }
}
function sh_checkbox(obid,oldvalue){
	var obj = document.getElementsByName(obid);
	if(oldvalue === '') return;
	for(var i = 0;i < obj.length;i ++){
		var re = new RegExp("(^|\\t)" + obj[i].value + "($|\\t)","ig");
		if(re.exec(oldvalue) != null){
			obj[i].checked = true;
		}
    }
	return;
}
