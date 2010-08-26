<?

	if (strpos($_SERVER["HTTP_HOST"], "demo") === false) {
		define(DEMO_MODE, 0);
	} else {
		define(DEMO_MODE, 1);
	}
	if (strpos($_SERVER["HTTP_HOST"], "demo") === false) {
		define(DEMO_LIVE_MODE, 0);
	} else {
		define(DEMO_LIVE_MODE, 1);
	}
	if ((strpos($_SERVER["HTTP_HOST"], "demo") === false) && (strpos($_SERVER["HTTP_HOST"], "intranet") === false)) {
		define(DEMO_DEV_MODE, 0);
	} else {
		define(DEMO_DEV_MODE, 1);
	}

	# ----------------------------------------------------------------------------------------------------
	# PHPINI
	# ----------------------------------------------------------------------------------------------------
	include("phpini.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE GENERAL CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("config.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUTOMATIC FEATURE
	# MOBILE FEATURE
	# ----------------------------------------------------------------------------------------------------
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)
	$autoMobileDetect = mobile_enableAutoDetect();
	if ($autoMobileDetect == "y") {

		$isiapp = "n";
		if (strpos($_SERVER["PHP_SELF"], "iapp") !== false) $isiapp = "y";
		$isMacMobile = mobile_isMacMobile();
		if (($isiapp == "y") && ($isMacMobile != "y")) {
			header("Location: ".DEFAULT_URL."");
			exit;
		}

		if ($isiapp != "y") {
			$isMobile = mobile_isMobile();
			if ((MOBILE_FEATURE == "on") && ($isMobile == "y") && !defined("EDIRECTORY_MOBILE")) {
				include(EDIRECTORY_ROOT."/conf/mobile.inc.php");
				header("Location: ".DEFAULT_URL."/".EDIRECTORY_MOBILE_LABEL."");
				exit;
			} elseif (defined("EDIRECTORY_MOBILE") && (EDIRECTORY_MOBILE == "on") && ((MOBILE_FEATURE != "on") || ($isMobile != "y"))) {
				header("Location: ".DEFAULT_URL."");
				exit;
			}
		}

	}
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)

?>
