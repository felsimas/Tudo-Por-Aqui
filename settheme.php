<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /settheme.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
	$_GET = format_magicQuotes($_GET);
	$_POST = format_magicQuotes($_POST);
	$_COOKIE = format_magicQuotes($_COOKIE);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$expire = 60*60*24*30*12;
	if ($_COOKIE["edir_theme"]) {
		setcookie("edir_theme", $_COOKIE["edir_theme"], time() + $expire, EDIRECTORY_FOLDER);
	}
	if ($_GET["theme"]) {
		setcookie("edir_theme", $_GET["theme"], time() + $expire, EDIRECTORY_FOLDER);
	} else {
		setcookie("edir_theme", "", time() - $expire, EDIRECTORY_FOLDER);
	}

	$destiny = $_GET["destiny"] ? $_GET["destiny"] : $_POST["destiny"];
	$destiny = urldecode($destiny);
	if ($destiny) {
		$destiny = system_denyInjections($destiny);
		if (strpos($destiny, "://") !== false) {
			if (strpos($destiny, $_SERVER["HTTP_HOST"]) === false) {
				$destiny = "";
			}
		}
	}
	if ($_SERVER["QUERY_STRING"]) {
		if (strpos($_SERVER["QUERY_STRING"], "query=") !== false) {
			$query = substr($_SERVER["QUERY_STRING"], strpos($_SERVER["QUERY_STRING"], "query=")+6);
		} else {
			$query = $_GET["query"] ? $_GET["query"] : $_POST["query"];
			$query = urldecode($query);
		}
	} else {
		$query = $_GET["query"] ? $_GET["query"] : $_POST["query"];
		$query = urldecode($query);
	}
	if ($query) {
		$query = system_denyInjections($query);
	}
	if ($destiny) {
		$url = $destiny;
		if ($query) $url .= "?".$query;
	} else {
		$url = DEFAULT_URL;
	}

	header("Location: ".$url);
	exit;

?>
