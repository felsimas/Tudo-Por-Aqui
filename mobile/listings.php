<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /mobile/listings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/mobile.inc.php");
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content();
	$sitecontentinfo = $contentObj->retrieveContentInfoByType("Listing Home");
	if ($sitecontentinfo) {
		$headertagtitle = $sitecontentinfo["title"];
	} else {
		$headertagtitle = "";
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;
	include(MOBILE_EDIRECTORY_ROOT."/layout/header.php");

?>

	<? include("./breadcrumb.php"); ?>

	<?

	$dbObj = db_getDBObject();

	$sql = "SELECT value FROM ListingLevel WHERE detail = 'y' ORDER BY value DESC LIMIT 1";
	$result = $dbObj->query($sql);
	$row = mysql_fetch_assoc($result);
	$level = $row["value"];

	unset($searchReturn);
	$searchReturn = search_frontListingSearch($_GET, "random");
	$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." Listing.level = ".$level." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT ".MAX_ITEM_INDEXRESULTS."";
	$result = $dbObj->query($sql);

	if ($result) {

		while ($listing = mysql_fetch_assoc($result)) {
			include("./listingview.php");
		}

	} else {
		echo "<p class=\"warning\">".system_showText(LANG_MSG_NO_RESULTS_FOUND)."</p>";
	}

	?>

	<? include("./search.php"); ?>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MOBILE_EDIRECTORY_ROOT."/layout/footer.php");
?>
