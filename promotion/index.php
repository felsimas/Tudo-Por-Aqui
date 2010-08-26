<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /promotion/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Promotion Home";
	$sitecontentinfo = $contentObj->retrieveContentInfoByType($sitecontentSection);
	if ($sitecontentinfo) {
		$headertagtitle = $sitecontentinfo["title"];
		$headertagdescription = $sitecontentinfo["description"];
		$headertagkeywords = $sitecontentinfo["keywords"];
		$sitecontent = $sitecontentinfo["content"];
	} else {
		$headertagtitle = "";
		$headertagdescription = "";
		$headertagkeywords = "";
		$sitecontent = "";
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$extrastyle = DEFAULT_URL."/layout/front.css";
	$banner_section = "listing";
	$headertag_title = $headertagtitle;
	$headertag_description = $headertagdescription;
	$headertag_keywords = $headertagkeywords;
	include(EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	if (EDIR_THEME) {
		include(THEMEFILE_DIR."/".EDIR_THEME."/body/promotion_index.php");
	} else {
		include(EDIRECTORY_ROOT."/frontend/body/promotion_index.php");
	}

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "listing";
	include(EDIRECTORY_ROOT."/layout/footer.php");

?>
