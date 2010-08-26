<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classified/results.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(CLASSIFIED_EDIRECTORY_ROOT."/mod_rewrite.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Classified Results";
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
	# RESULTS
	# ----------------------------------------------------------------------------------------------------

	$search_lock = false;
	if (CLASSIFIED_SCALABILITY_OPTIMIZATION == "on") {
		if (!$_GET["keyword"] && !$_GET["where"] && !$_GET["category_id"] && !$_GET["cidade_id"] && !$_GET["zip"] && !$_GET["id"]) {
			$_GET["id"] = 0;
			$search_lock = true;
		}
	}

	unset($searchReturn);
	$searchReturn = search_frontClassifiedSearch($_GET, "classified");
	$pageObj = new pageBrowsing($searchReturn["from_tables"], $screen, 10, $searchReturn["order_by"], "Classified.title", $letra, $searchReturn["where_clause"], $searchReturn["select_columns"], "Classified", $searchReturn["group_by"]);
	$classifieds = $pageObj->retrievePage();

	$paging_url = CLASSIFIED_DEFAULT_URL."/results.php";

	$array_search_params = array();
	foreach ($_GET as $name => $value){
		if ($name != "screen" && $name != "letra"){
			$array_search_params[] = $name."=".$value;
		}
	}
	$url_search_params = implode("&amp;", $array_search_params);

	$letras = $pageObj->getString("letras");
	foreach ($letras as $each_letra) {
		if ($each_letra == "#") {
			$letras_menu .= "<a href=\"$paging_url?letra=no".(($url_search_params) ? "&amp;$url_search_params" : "")."\" ".(($letra == "no") ? "class=\"firstLetter\" style=\"color:#EF413D\"" : "" ).">".strtoupper($each_letra)."</a>";
		} else {
			$letras_menu .= "<a href=\"$paging_url?letra=".$each_letra.(($url_search_params) ? "&amp;$url_search_params" : "")."\" ".(($each_letra == $letra) ? "style=\"color:#EF413D\"" : "" ).">".strtoupper($each_letra)."</a>";
		}
	}
	$user = true;
	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$extrastyle = DEFAULT_URL."/layout/results.css";
	$banner_section = "classified";
	$headertag_title = $headertagtitle;
	$headertag_description = $headertagdescription;
	$headertag_keywords = $headertagkeywords;
	if ($browsebycategory) {
		if ($category_id) {
			$categoryObjHeaderTag = new ClassifiedCategory($category_id);
			if ($categoryObjHeaderTag->getStringLang(EDIR_LANGUAGE, "seo_description")) $headertag_description = $categoryObjHeaderTag->getStringLang(EDIR_LANGUAGE, "seo_description");
			if ($categoryObjHeaderTag->getStringLang(EDIR_LANGUAGE, "seo_keywords")) $headertag_keywords = $categoryObjHeaderTag->getStringLang(EDIR_LANGUAGE, "seo_keywords");
			unset($categoryObjHeaderTag);
		}
	} elseif ($browsebylocation) {
		include(INCLUDES_DIR."/code/headertaglocation.php");
	}
	include(EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	if (EDIR_THEME) {
		include(THEMEFILE_DIR."/".EDIR_THEME."/body/classified_results.php");
	} else {
		include(EDIRECTORY_ROOT."/frontend/body/classified_results.php");
	}

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "classified";
	include(EDIRECTORY_ROOT."/layout/footer.php");

?>
