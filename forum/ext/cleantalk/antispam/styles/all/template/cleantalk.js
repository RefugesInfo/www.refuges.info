var ct_date = new Date();

function ctSetCookie(c_name, value) {
	document.cookie = c_name + "=" + encodeURIComponent(value) + "; path=/";
}
ctSetCookie("ct_ps_timestamp", Math.floor(new Date().getTime()/1000));
ctSetCookie("ct_timezone", "0");
setTimeout(function(){
	ctSetCookie(ct_cookie_name, ct_cookie_value);
	ctSetCookie("ct_timezone", ct_date.getTimezoneOffset()/60*(-1));
},1000);
