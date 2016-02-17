/**
 * ajax 为同步执行
 * 
 * @param {type}
 *            param
 */
$.ajaxSetup({
	async : false
});

var Utils = new Object();

Utils.htmlEncode = function(text) {
	return text.replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g,
			'&lt;').replace(/>/g, '&gt;');
}

Utils.trim = function(text) {
	if (typeof (text) == "string") {
		return text.replace(/^\s*|\s*$/g, "");
	} else {
		return text;
	}
}

Utils.isEmpty = function(val) {
	switch (typeof (val)) {
	case 'string':
		return Utils.trim(val).length == 0 ? true : false;
		break;
	case 'number':
		return val == 0;
		break;
	case 'object':
		return val == null;
		break;
	case 'array':
		return val.length == 0;
		break;
	default:
		return true;
	}
}

Utils.isNumber = function(val) {
	var reg = /^[\d|\.|,]+$/;
	return reg.test(val);
}

Utils.isInt = function(val) {
	if (val == "") {
		return false;
	}
	var reg = /\D+/;
	return !reg.test(val);
}

Utils.isEmail = function(email) {
	var reg1 = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)/;

	return reg1.test(email);
}

Utils.isTel = function(tel) {
	var reg = /^[\d|\-|\s|\_]+$/; // 只允许使用数字-空格等

	return reg.test(tel);
}

Utils.fixEvent = function(e) {
	var evt = (typeof e == "undefined") ? window.event : e;
	return evt;
}

Utils.srcElement = function(e) {
	if (typeof e == "undefined")
		e = window.event;
	var src = document.all ? e.srcElement : e.target;

	return src;
}

Utils.isTime = function(val) {
	var reg = /^\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}$/;

	return reg.test(val);
}

Utils.x = function(e) { // 当前鼠标X坐标
	return Browser.isIE ? event.x + document.documentElement.scrollLeft - 2
			: e.pageX;
}

Utils.y = function(e) { // 当前鼠标Y坐标
	return Browser.isIE ? event.y + document.documentElement.scrollTop - 2
			: e.pageY;
}

Utils.request = function(url, item) {
	var sValue = url.match(new RegExp("[\?\&]" + item + "=([^\&]*)(\&?)", "i"));
	return sValue ? sValue[1] : sValue;
}