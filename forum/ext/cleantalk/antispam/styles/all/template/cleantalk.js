var ct_date = new Date();

function ctSetCookie(c_name, value) {
	document.cookie = c_name + "=" + encodeURIComponent(value) + ";SameSite=Strict; path=/"; //HACK from Dominique. Check if it's included a furter cleantalk edition
}
ctSetCookie("ct_ps_timestamp", Math.floor(new Date().getTime()/1000));
ctSetCookie("ct_timezone", "0");
setTimeout(function(){
	ctSetCookie(ct_cookie_name, ct_cookie_value);
	ctSetCookie("ct_timezone", ct_date.getTimezoneOffset()/60*(-1));
},1000);
