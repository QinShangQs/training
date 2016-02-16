$.extend($.fn.validatebox.defaults.rules, {
	mobile : {// 验证电话号码
		validator : function(value) {
			return /^(13|15|18|17)\d{9}$/i.test(value);
		},
		message : '格式不正确,请使用手机号码!'
	},
	/* 必须和某个字段相等 */
	equalTo : {
		validator : function(value, param) {
			return $(param[0]).val() == value;
		},
		message : '字段不匹配'
	},
	minLength : {
		validator : function(value, param) {
			return value.length >= param[0];
		},
		message : '最小长度不能小于{0}个字符.'
	},
	maxLength : {
		validator : function(value, param) {
			return value.length <= param[0];
		},
		message : '最大长度不能超过{0}个字符.'
	},
	// 国内邮编验证
	zipcode : {
		validator : function(value) {
			var reg = /^[1-9]\d{5}$/;
			return reg.test(value);
		},
		message : '邮编必须是非0开始的6位数字.'
	},
	math : {
		validator : function(value) {
			return  !isNaN( value ) ;
		},
		message : '正确输入数字'
	}

});
