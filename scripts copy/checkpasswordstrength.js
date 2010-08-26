
function checkPasswordStrength(password, path) {
	var myStrength;
	document.getElementById("checkPasswordStrength").className = "strengthLoading";
	document.getElementById("checkPasswordStrength").innerHTML = showText(LANG_JS_LOADING);
	if (password.length > 0) {
		myStrength = 0;
		if (password.match(/[a-z]/)) {
			myStrength++;
		}
		if (password.match(/[A-Z]/)) {
			myStrength++;
		}
		if (password.match(/[0-9]/g)) {
			myStrength++;
		}
		if (password.match(/[!,@,#,$,%,&,*,(,),\-,_,=,+,\',\",\\,|,\,,<,.,>,;,:,/,?,\[,{,\],}]/g)) {
			myStrength++;
		}
		if (password.length >= 8) {
			myStrength++;
		}
		if (password.length >= 12) {
			myStrength++;
		}
		if (password.length >= 16) {
			myStrength++;
		}
		if (myStrength == 1) {
			document.getElementById("checkPasswordStrength").className = "strengthWeak";
			document.getElementById("checkPasswordStrength").innerHTML = showText(LANG_JS_LABEL_WEAK);
		} else if (myStrength == 2) {
			document.getElementById("checkPasswordStrength").className = "strengthBad";
			document.getElementById("checkPasswordStrength").innerHTML = showText(LANG_JS_LABEL_BAD);
		} else if (myStrength == 3) {
			document.getElementById("checkPasswordStrength").className = "strengthGood";
			document.getElementById("checkPasswordStrength").innerHTML = showText(LANG_JS_LABEL_GOOD);
		} else if (myStrength >= 4) {
			document.getElementById("checkPasswordStrength").className = "strengthStrong";
			document.getElementById("checkPasswordStrength").innerHTML = showText(LANG_JS_LABEL_STRONG);
		} else {
			document.getElementById("checkPasswordStrength").className = "strengthNoPassword";
			document.getElementById("checkPasswordStrength").innerHTML = "";
		}
	} else {
		document.getElementById("checkPasswordStrength").className = "strengthNoPassword";
		document.getElementById("checkPasswordStrength").innerHTML = "";
	}
}
