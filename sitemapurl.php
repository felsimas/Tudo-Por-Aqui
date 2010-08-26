<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /sitemapurl.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	if ((MODREWRITE_FEATURE != "on") || (SITEMAP_FEATURE != "on")) { exit; }
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$_GET = format_magicQuotes($_GET);
	$_POST = format_magicQuotes($_POST);
	$file = $_GET["file"] ? $_GET["file"] : $_POST["file"];
	$file = urldecode($file);
	if ($file) {
		$file = system_denyInjections($file);
		if (strpos($file, "://") !== false) {
			if (strpos($file, $_SERVER["HTTP_HOST"]) === false) {
				$file = "";
			}
		}
	}
	if ($file) {
		if (file_exists(EDIRECTORY_ROOT."/custom/sitemap/".$file)) {
			$handle = fopen(EDIRECTORY_ROOT."/custom/sitemap/".$file, "r");
			if ($handle) {
				while (!feof($handle)) {
					$buffer = fgets($handle);
					echo $buffer;
				}
				fclose($handle);
			}
		}
	}

?>
