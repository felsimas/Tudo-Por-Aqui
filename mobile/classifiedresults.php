<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /mobile/classifiedresults.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/mobile.inc.php");
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content();
	$sitecontentinfo = $contentObj->retrieveContentInfoByType("Classified Results");
	if ($sitecontentinfo) {
		$headertagtitle = $sitecontentinfo["title"];
	} else {
		$headertagtitle = "";
	}

	# ----------------------------------------------------------------------------------------------------
	# QUERY STRING
	# ----------------------------------------------------------------------------------------------------
	include("./query_string.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;
	include(MOBILE_EDIRECTORY_ROOT."/layout/header.php");

?>

	<? include("./breadcrumb.php"); ?>

	<?

	$search_lock = false;
	if (CLASSIFIED_SCALABILITY_OPTIMIZATION == "on") {
		if (!$_GET["keyword"]) {
			$_GET["id"] = 0;
			$search_lock = true;
		}
	}

	if (!$page) $page = 1;

	$message_search_for = "<p class=\"searchResults\">".system_showText(LANG_SEARCHRESULTS)." ".system_showText(LANG_SEARCHRESULTS_KEYWORD)." <span class=\"bold\">".$keyword."</span></p>";

	$dbObj = db_getDBObject();

	unset($searchReturn);
	$searchReturn = search_frontClassifiedSearch($_GET, "mobile");
	$sql = "SELECT SQL_CALC_FOUND_ROWS ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT ".(($page-1)*MAX_ITEM_PER_PAGE).",".MAX_ITEM_PER_PAGE."";
	$result = $dbObj->query($sql);

	if ($result) {

		if ($keyword) echo $message_search_for;

		$sqlFoundRows = "SELECT FOUND_ROWS()";
		$resultFoundRows = $dbObj->query($sqlFoundRows);
		$foundRows = mysql_fetch_row($resultFoundRows);
		$item_total_amount = $foundRows[0];

		$item_amount = mysql_num_rows($result);

		if ($item_amount > 0) {

			include("./searchstatistics.php");

			while ($classified = mysql_fetch_assoc($result)) {
				include("./classifiedview.php");
			}

			include("./paging.php");

		} else {
			if ($search_lock) {
				echo "<p class=\"warning\">".system_showText(LANG_MSG_LEASTONEPARAMETER)."</p>";
			} else {
				echo "<p class=\"warning\">".system_showText(LANG_MSG_NO_RESULTS_FOUND)."</p>";
			}
			include("./search.php");
		}

	} else {
		echo "<p class=\"warning\">".system_showText(LANG_MSG_NO_RESULTS_FOUND)."</p>";
	}

	?>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MOBILE_EDIRECTORY_ROOT."/layout/footer.php");
?>
