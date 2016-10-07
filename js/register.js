var lastregcode = lastmname = lastpassword = lastemail = '';
function checkregcode() {
	var regcode = $('regcode').value;
	if(regcode == lastregcode) {
		return;
	} else {
		lastregcode = regcode;
	}
	var cr = $('checkregcode');
	if(!(/[0-9A-Za-z]{4}/.test(regcode))){
		warning(cr,'验证码为四位！');
		return;
	}
	ajaxresponse('checkregcode', 'action=checkregcode&regcode=' + regcode);
}

function checkmname() {
	var mname = trim($('mname').value);
	if(mname == lastmname) {return;}
	else {lastmname = mname;}
	var cu = $('checkmname');
	var unlen = mname.replace(/[^\x00-\xff]/g, "**").length;

	if(unlen < 3 || unlen > 15) {
		warning(cu, unlen < 3 ? "用户名少于3个字符！" : "用户名超过15个字符！");
		return;
	}
	ajaxresponse('checkmname', 'action=checkmname&mname=' + mname);
}

function checkpassword(confirm){
	var password = trim($('password').value);
	if(!confirm && password == lastpassword) {
		return;
	} else {
		lastpassword = password;
	}
	var cp = $('checkpassword');
	if(password == '' || (/[\'\"\\]/.test(password))) {
		warning(cp, '密码空或包含非法字符！');
		return false;
	} else {
		cp.style.display = 'none';
		if(!confirm) {
			checkpassword2(true);
		}
	return true;
	}
}

function checkpassword2(confirm){
	var password = trim($('password').value);
	var password2 = trim($('password2').value);
	var cp2 = $('checkpassword2');
	if(password2 != '') {
		checkpassword(true);
	}
	if(password == '' || (confirm && password2 == '')){
		cp2.style.display = 'none';
		return;
	}
	if(password != password2) {
		warning(cp2, '两次输入的密码不一致！');
	} else {
		cp2.style.display = 'none';
	}
}

function checkemail() {
	var email = trim($('email').value);
	if(email == lastemail) {
		return;
	} else {
		lastemail = email;
	}
	var ce = $('checkemail');
	if(!(/^[\-\.\w]+@[\.\-\w]+(\.\w+)+$/.test(email))) {
		warning(ce, 'Email 地址无效！');
		return;
	}else{
		ce.style.display = 'none';
	}
}
function warning(obj, msg){
	var ton = obj.id.substr(5,obj.id.length);
	var wobj = (ton == 'password2') ? $('password') : $(ton);
	wobj.select();
	obj.style.display = '';
	obj.innerHTML = '<img src="images/default/check_error.gif" width="13" height="13"> &nbsp; ' + msg;
	obj.className = "warning";
}

function ajaxresponse(objname, data) {
	var x = new Ajax('XML', objname);
	x.get('register.php?inajax=1&' + data, function(s){
		var obj = $(objname);
		if(s == 'succeed') {
			obj.style.display = '';
			obj.innerHTML = '<img src="images/default/check_right.gif" width="13" height="13">';
			obj.className = "warning";
		} else {
			warning(obj, s);
		}
	});
}
