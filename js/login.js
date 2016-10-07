var lastregcode = lastusername = lastpassword = '';
function checkregcode() {
	var regcode = $('regcode').value;
	if(regcode == lastregcode) {
		return;
	} else {
		lastregcode = regcode;
	}
	var cr = $('checkregcode');
	if(!(/[0-9]{4}/.test(regcode))){
		warning(cr,'验证码为四位数字，请正确填写。');
		return;
	}else{
		cr.style.display = 'none';
	}
}

function checkusername() {
	var username = trim($('username').value);
	if(username == lastusername) {return;}
	else {lastusername = username;}
	var cu = $('checkusername');
	var unlen = username.replace(/[^\x00-\xff]/g, "**").length;

	if(unlen < 3 || unlen > 15) {
		warning(cu, unlen < 3 ? "用户名少于3个字符。" : "用户名超过15个字符。");
		return;
	}else{
		cu.style.display = 'none';
	}
}

function checkpassword(){
	var password = trim($('password').value);
	if(password == lastpassword) {
		return;
	} else {
		lastpassword = password;
	}
	var cp = $('checkpassword');
	if(password == '' || (/[\'\"\\]/.test(password))) {
		warning(cp, '密码空或包含非法字符，请重新填写。');
		return;
	} else {
		cp.style.display = 'none';
	}
}

function warning(obj, msg){
	var ton = obj.id.substr(5,obj.id.length);
	var wobj = $(ton);
	wobj.select();
	obj.style.display = '';
	obj.innerHTML = '<img src="images/default/check_error.gif" width="13" height="13"> &nbsp; ' + msg;
	obj.className = "warning";
}
