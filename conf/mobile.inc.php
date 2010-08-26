<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /conf/mobile.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY MOBILE LABEL
	# NOTE: The label is the name of the subfolder or the name of the subdomain.
	# If both are enabled, both need to have same name.
	# ----------------------------------------------------------------------------------------------------
	define(EDIRECTORY_MOBILE_LABEL, "mobile");

	# ----------------------------------------------------------------------------------------------------
	# DEFINE MOBILE CONSTANTS
	# ----------------------------------------------------------------------------------------------------
	define(MAX_ITEM_PER_PAGE,     10);
	define(MAX_ITEM_INDEXRESULTS,  3);
	define(MAX_DESC_LEN,          80);

	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY MOBILE
	# ----------------------------------------------------------------------------------------------------
	define(EDIRECTORY_MOBILE, "on");

	# ----------------------------------------------------------------------------------------------------
	# AUTOMATIC FEATURES
	# DEFINE EDIRECTORY FOLDER
	# DEFINE MOBILE EDIRECTORY FOLDER
	# DEFINE EDIRECTORY ROOT
	# DEFINE DEFAULT URL
	# ----------------------------------------------------------------------------------------------------
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)
	unset($found_edirectory_folder);
	$found_edirectory_folder = false;
	if (defined("EDIRECTORY_ROOT")) {
		$handleMobile = fopen(EDIRECTORY_ROOT."/conf/config.inc.php", "r");
	} else {
		$handleMobile = fopen("../conf/config.inc.php", "r");
	}
	if ($handleMobile) {
		$lookforMobile = "define(EDIRECTORY_FOLDER,";
		do {
			$bufferMobile = fgets($handleMobile);
			if (($posMobile = strpos($bufferMobile, $lookforMobile)) !== false) {
				$edirectory_folder = substr($bufferMobile, ($posMobile+strlen($lookforMobile)+1));
				$edirectory_folder = substr($edirectory_folder, (strpos($edirectory_folder, "\"")+1));
				$edirectory_folder = substr($edirectory_folder, 0, strrpos($edirectory_folder, "\""));
				define(EDIRECTORY_FOLDER, $edirectory_folder);
				$found_edirectory_folder = true;
			}
		} while (!$found_edirectory_folder && !feof($handleMobile));
		fclose($handleMobile);
	}
	unset($found_edirectory_folder);
	if (strpos($_SERVER["HTTP_HOST"], EDIRECTORY_MOBILE_LABEL) !== false) {
		define(MOBILE_EDIRECTORY_FOLDER, "");
		define(EDIRECTORY_ROOT, str_replace("/".EDIRECTORY_MOBILE_LABEL, "", $_SERVER["DOCUMENT_ROOT"]));
		define(DEFAULT_URL, "http://".str_replace(EDIRECTORY_MOBILE_LABEL.".", "", $_SERVER["HTTP_HOST"]).EDIRECTORY_FOLDER);
	} else {
		define(MOBILE_EDIRECTORY_FOLDER, EDIRECTORY_FOLDER."/".EDIRECTORY_MOBILE_LABEL);
	}
	// *** AUTOMATIC FEATURE *** (DONT CHANGE THESE LINES)

	# ----------------------------------------------------------------------------------------------------
	# DEFINE MOBILE EDIRECTORY ROOT
	# ----------------------------------------------------------------------------------------------------
	define(MOBILE_EDIRECTORY_ROOT, $_SERVER["DOCUMENT_ROOT"].MOBILE_EDIRECTORY_FOLDER);

	# ----------------------------------------------------------------------------------------------------
	# DEFINE MOBILE DEFAULT URL
	# ----------------------------------------------------------------------------------------------------
	define(MOBILE_DEFAULT_URL, "http://".$_SERVER["HTTP_HOST"].MOBILE_EDIRECTORY_FOLDER);

?>
