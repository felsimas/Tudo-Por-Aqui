<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /article/allcategories.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Article View All Categories";
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
	$banner_section = "article";
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
		include(THEMEFILE_DIR."/".EDIR_THEME."/body/general.php");
	} else {
		include(EDIRECTORY_ROOT."/frontend/body/general.php");
	}

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "article";
	include(EDIRECTORY_ROOT."/layout/footer.php");

?>
