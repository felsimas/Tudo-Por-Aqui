<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /conf/theme.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEFINITIONS
	# ----------------------------------------------------------------------------------------------------

	//set default theme
	$edir_default_theme = "edirectory";

	//set all available themes separated by comma
	$edir_themes = "edirectory,edirectorycompact,edirectoryclassic,golfcourse,realestate,restaurant";
	$edir_themenames = "eDirectory,eDirectory Compact,eDirectory Classic,Golf Course,Real Estate,Restaurant";

	//code to setup one specific theme from all available themes
	$edir_theme = "edirectory";
	
	if (DEMO_MODE == 0) {
		@include_once(EDIRECTORY_ROOT.'/custom/theme.inc.php');
	} else {
		if ($_COOKIE["edir_theme"] && (strpos($edir_themes, $_COOKIE["edir_theme"]) !== false)) {
			$edir_theme = $_COOKIE["edir_theme"];
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# AUTOMATIC FEATURES
	# ----------------------------------------------------------------------------------------------------
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)  
	define(EDIR_DEFAULT_THEME, $edir_default_theme);
	define(EDIR_THEMES, $edir_themes);
	define(EDIR_THEMENAMES, $edir_themenames);
	if ($edir_theme && ($edir_theme != "edirectory") && file_exists(THEMEFILE_DIR."/".$edir_theme."/".$edir_theme.".php")) {
		define(EDIR_THEME, $edir_theme);
	} else {
		define(EDIR_THEME, "");
	}
	unset($edir_default_theme);
	unset($edir_themes);
	unset($edir_themenames);
	unset($edir_theme);
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)

?>