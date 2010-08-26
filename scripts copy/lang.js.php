<?php



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /scripts/lang.js.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	$user_defined_constants = get_defined_constants();

	header("Content-type: text/javascript");

	echo "//Javascript language variables\n\n";

	foreach ($user_defined_constants as $key=>$value) {
		if (substr($key,0,7) == "LANG_JS") {
			echo "$key = \"".str_replace("+"," ",urlencode($value))."\";\n";
		}
	}

?>
