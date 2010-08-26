<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /conf/language.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEFINITIONS
	# ----------------------------------------------------------------------------------------------------

	
	//set default language
	//any changes in lines bellow must to be changed in database (table lang)
	$edir_default_language = "en_us";

	//set all available languages separated by comma
	//up to 5 languages (edirectory performance)
	//if you want more than 5 languages, contact edirectory customization team
	//any changes in lines bellow must to be changed in database (table lang)
	$edir_languages = "en_us,pt_br,es_es,fr_fr";
	$edir_languagenames = "English,Português,Español,Français";

	//up to 5 languages (edirectory performance)
	//if you want more than 5 languages, contact edirectory customization team
	define("MAX_ENABLED_LANGUAGES", 5);

	//loading the definitions file
	$definitions_file = EDIRECTORY_ROOT.'/custom/lang/language.inc.php';
	if (file_exists($definitions_file)) {
		include_once($definitions_file);
	}

	//code to setup one specific language from all available languages
	$edir_language = $edir_default_language;
	if (defined("EDIRECTORY_MOBILE") && (EDIRECTORY_MOBILE == "on")) {
		if ($_GET["lang"] && (strpos($edir_languages, $_GET["lang"]) !== false)) {
			$edir_language = $_GET["lang"];
		}
	} else {
		if ($_COOKIE["edir_language"] && (strpos($edir_languages, $_COOKIE["edir_language"]) !== false)) {
			$edir_language = $_COOKIE["edir_language"];
		}
	}

	# ----------------------------------------------------------------------------------------------------
	# AUTOMATIC FEATURES
	# ----------------------------------------------------------------------------------------------------
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)
	include(EDIRECTORY_ROOT."/includes/code/language.php");
	unset($edir_default_language);
	unset($edir_languages);
	unset($edir_languagenames);
	unset($edir_language);
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)

?>