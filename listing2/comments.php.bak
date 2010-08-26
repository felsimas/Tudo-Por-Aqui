<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /listing/comments.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(LISTING_EDIRECTORY_ROOT."/mod_rewrite.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	setting_get("review_listing_enabled", $review_enabled);
	if ($review_enabled != "on") {
		$error_message = system_showText(LANG_REVIEWDISABLE);
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$item_type = "listing";
	$item_id   = $_GET['item_id'];
	if (!$item_id && $_GET['id']) $item_id = $_GET['id'];

	include(INCLUDES_DIR."/code/review.php");
	$listingObj = $itemObj;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------  
	// Page Browsing /////////////////////////////////////////
	if ($item_id) $sql_where[] = " item_type = 'listing' AND item_id = $item_id ";
	if (true)        $sql_where[] = " review IS NOT NULL AND review != '' ";
	if (true)        $sql_where[] = " approved = '1' ";
	if ($sql_where)  $sqlwhere .= " ".implode(" AND ", $sql_where)." ";

	$pageObj  = new pageBrowsing("Review", $screen, 5, "added DESC", "", "", $sqlwhere);
	$reviewsArr = $pageObj->retrievePage("object");

	$paging_url = LISTING_DEFAULT_URL."/comments.php";

	$array_search_params = array();
	foreach ($_GET as $name => $value){
		if ($name != "screen" && $name != "letra"){
			$array_search_params[] = $name."=".$value;
		}
	}
	$url_search_params = implode("&amp;", $array_search_params);

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$extrastyle = DEFAULT_URL."/layout/results.css";
	$banner_section = "listing";
	$headertag_title = system_showText(LANG_REVIEWSOF)." ".(($listingObj->getString("seo_title"))?($listingObj->getString("seo_title")):($listingObj->getString("title")));
	$headertag_description = (($listingObj->getStringLang(EDIR_LANGUAGE, "seo_description"))?($listingObj->getStringLang(EDIR_LANGUAGE, "seo_description")):($listingObj->getStringLang(EDIR_LANGUAGE, "description")));
	$headertag_keywords = (($listingObj->getStringLang(EDIR_LANGUAGE, "seo_keywords"))?($listingObj->getStringLang(EDIR_LANGUAGE, "seo_keywords")):(str_replace(" || ", ", ", $listingObj->getStringLang(EDIR_LANGUAGE, "keywords"))));
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
	$banner_section = "listing";
	include(EDIRECTORY_ROOT."/layout/footer.php");

?>
