<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /conf/phpini.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# PHP.INI DEFINITIONS
	# ----------------------------------------------------------------------------------------------------
	ini_set("max_execution_time", "3600");
	ini_set("memory_limit", "128M");
	ini_set("session.use_only_cookies", "1");
	if (DEMO_DEV_MODE) {
		ini_set("display_errors", "1");
	} else {
		ini_set("display_errors", "0");
	}

	# ----------------------------------------------------------------------------------------------------
	# ERROR REPORTING
	# ----------------------------------------------------------------------------------------------------
	error_reporting(E_ALL ^ E_NOTICE);

	# ----------------------------------------------------------------------------------------------------
	# FIX BETWEEN PHP VERSIONS
	# ----------------------------------------------------------------------------------------------------
	if (!isset($_COOKIE)) {
		$_COOKIE = &$HTTP_COOKIE_VARS;
	}

?>
