<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /mobile/setlanguage.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/mobile.inc.php");
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
	$_GET = format_magicQuotes($_GET);
	$_POST = format_magicQuotes($_POST);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

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
		$query = explode("&", $query);
		unset($queryAux);
		foreach ($query as $queryvar) {
			if (strpos($queryvar, "lang") === false) $queryAux[] = $queryvar;
		}
		if ($queryAux) $query = implode("&", $queryAux);
		else $query = "";
		if ($query) {
			$query = system_denyInjections($query);
		}
	}
	if ($_GET["lang"]) {
		if ($query) $query = "lang=".$_GET["lang"]."&".$query;
		else $query = "lang=".$_GET["lang"];
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
