if(navigator.appName=='Netscape')
var language=navigator.language;else
var language=navigator.browserLanguage;language=language.toLowerCase();if(language.indexOf('en')>-1)document.location.href='en/';else if(language.indexOf('thai')>-1)document.location.href='thai/';else if(language.indexOf('zh-tw')>-1)document.location.href='zh_tw/';else
$(function(){$(".lang").hover(function(){$("#sel_lang").show();},function(){$("#sel_lang").hide()});});