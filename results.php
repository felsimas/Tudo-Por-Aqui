<?
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Directory Results";
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
	if (LISTING_SCALABILITY_OPTIMIZATION == "on") {
		if (!$_GET["keyword"] && !$_GET["where"] && !$_GET["category_id"] && !$_GET["cidade_id"] && !$_GET["zip"] && !$_GET["template_id"] && !$_GET["id"]) {
			$_GET["id"] = 0;
			$search_lock = true;
		}
	}

	unset($searchReturn);
	$searchReturn = search_frontListingSearch($_GET, "listing");
	
	
	//sELECT SQL_CALC_FOUND_ROWS Listing.*, review.avgrating, review.countrating, Report_Listing.views FROM Listing left JOIN ( SELECT item_id, avg( rating ) AS avgrating, count( rating ) AS countrating FROM `Review` WHERE approved =1 GROUP BY item_id ) review ON Listing.id = review.item_id INNER JOIN ( SELECT listing_id, sum( report_amount ) AS views FROM `Report_Listing` WHERE 1 GROUP BY listing_id ) Report_Listing ON Listing.id = Report_Listing.listing_id WHERE Listing.status = 'A' ORDER BY avgrating desc, review.countrating desc, Report_Listing.views DESC, Listing.level DESC, Listing.random_number DESC, Listing.title, Listing.id LIMIT 0,10
	
	
	$pageObj = new pageBrowsing($searchReturn["from_tables"], $screen, 10, $searchReturn["order_by"], "Listing.title", $letra, $searchReturn["where_clause"], $searchReturn["select_columns"], "Listing", $searchReturn["group_by"]);
	$listings = $pageObj->retrievePage();

	$paging_url = DEFAULT_URL."/results.php";

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
	$headertag_title = $headertagtitle;
	$headertag_description = $headertagdescription;
	$headertag_keywords = $headertagkeywords;
	include(EDIRECTORY_ROOT."/layout/header_results.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	if (EDIR_THEME) {
	} else {
		include(EDIRECTORY_ROOT."/frontend/body/results.php");
	}

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/layout/footer.php");
 
?>
