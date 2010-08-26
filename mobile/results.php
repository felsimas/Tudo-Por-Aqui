<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /mobile/results.php
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
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content();
	$sitecontentinfo = $contentObj->retrieveContentInfoByType("Directory Results");
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

	$message_search_for = "<p>".system_showText(LANG_SEARCHRESULTS)." ".system_showText(LANG_SEARCHRESULTS_KEYWORD)." <span class=\"bold\">".$keyword."</span></p>";
	$message_browse_section = "<h1>".system_showText(system_highlightLastWord(LANG_LABEL_BROWSESECTION))."</h1>";

	$this_items = 0;

	if ($keyword) {

		$dbObj = db_getDBObject();

		####################################################################################################
		### LISTING
		####################################################################################################
		unset($searchReturn);
		$searchReturn = search_frontListingSearch($_GET, "mobile");
		$sql = "SELECT SQL_CALC_FOUND_ROWS ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT 0,".MAX_ITEM_INDEXRESULTS."";

		$result = $dbObj->query($sql);

		if ($result) {

			$sqlFoundRows = "SELECT FOUND_ROWS()";
			$resultFoundRows = $dbObj->query($sqlFoundRows);
			$foundRows = mysql_fetch_row($resultFoundRows);
			$listings = $foundRows[0];

			if ($listings > 0) {
				if ($this_items == 0) {
					if ($keyword) echo $message_search_for;
					else echo $message_browse_section;
				}
				$this_items += $listings;
				?><p class="generalResults"><a href="<?=MOBILE_DEFAULT_URL?>/listingresults.php<?=(($query_string_mobile) ? ("?".$query_string_mobile) : (""))?>"><?=system_showText(LANG_MENU_LISTING);?><span> (<?=$listings?>)</span></a></p><?
				while ($listing = mysql_fetch_assoc($result)) {
					include("./listingview.php");
				}
				if ($listings > MAX_ITEM_INDEXRESULTS) {
					?><p class="moreResults"><a href="<?=MOBILE_DEFAULT_URL?>/listingresults.php<?=(($query_string_mobile) ? ("?".$query_string_mobile) : (""))?>"><?=system_showText(LANG_LABEL_MORELISTINGS);?></a></p><?
				}
			}

		}
		####################################################################################################

		####################################################################################################
		### EVENT
		####################################################################################################
		if (EVENT_FEATURE == "on") {

			unset($searchReturn);
			$searchReturn = search_frontEventSearch($_GET, "mobile");
			$sql = "SELECT SQL_CALC_FOUND_ROWS ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT 0,".MAX_ITEM_INDEXRESULTS."";

			$result = $dbObj->query($sql);

			if ($result) {

				$sqlFoundRows = "SELECT FOUND_ROWS()";
				$resultFoundRows = $dbObj->query($sqlFoundRows);
				$foundRows = mysql_fetch_row($resultFoundRows);
				$events = $foundRows[0];

				if ($events > 0) {
					if ($this_items == 0) {
						if ($keyword) echo $message_search_for;
						else echo $message_browse_section;
					}
					$this_items += $events;
					?><p class="generalResults"><a href="<?=MOBILE_DEFAULT_URL?>/eventresults.php<?=(($query_string_mobile) ? ("?".$query_string_mobile) : (""))?>"><?=system_showText(LANG_MENU_EVENT);?><span> (<?=$events?>)</span></a></p><?
					while ($event = mysql_fetch_assoc($result)) {
						include("./eventview.php");
					}
					if ($events > MAX_ITEM_INDEXRESULTS) {
						?><p class="moreResults"><a href="<?=MOBILE_DEFAULT_URL?>/eventresults.php<?=(($query_string_mobile) ? ("?".$query_string_mobile) : (""))?>"><?=system_showText(LANG_LABEL_MOREEVENTS);?></a></p><?
					}
				}

			}

		}
		####################################################################################################

		####################################################################################################
		### CLASSIFIED
		####################################################################################################
		if (CLASSIFIED_FEATURE == "on") {

			unset($searchReturn);
			$searchReturn = search_frontClassifiedSearch($_GET, "mobile");
			$sql = "SELECT SQL_CALC_FOUND_ROWS ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT 0,".MAX_ITEM_INDEXRESULTS."";

			$result = $dbObj->query($sql);

			if ($result) {

				$sqlFoundRows = "SELECT FOUND_ROWS()";
				$resultFoundRows = $dbObj->query($sqlFoundRows);
				$foundRows = mysql_fetch_row($resultFoundRows);
				$classifieds = $foundRows[0];

				if ($classifieds > 0) {
					if ($this_items == 0) {
						if ($keyword) echo $message_search_for;
						else echo $message_browse_section;
					}
					$this_items += $classifieds;
					?><p class="generalResults"><a href="<?=MOBILE_DEFAULT_URL?>/classifiedresults.php<?=(($query_string_mobile) ? ("?".$query_string_mobile) : (""))?>"><?=system_showText(LANG_MENU_CLASSIFIED);?><span> (<?=$classifieds?>)</span></a></p><?
					while ($classified = mysql_fetch_assoc($result)) {
						include("./classifiedview.php");
					}
					if ($classifieds > MAX_ITEM_INDEXRESULTS) {
						?><p class="moreResults"><a href="<?=MOBILE_DEFAULT_URL?>/classifiedresults.php<?=(($query_string_mobile) ? ("?".$query_string_mobile) : (""))?>"><?=system_showText(LANG_LABEL_MORECLASSIFIEDS);?></a></p><?
					}
				}

			}

		}
		####################################################################################################

		####################################################################################################
		### ARTICLE
		####################################################################################################
		if (ARTICLE_FEATURE == "on") {

			unset($searchReturn);
			$searchReturn = search_frontArticleSearch($_GET, "mobile");
			$sql = "SELECT SQL_CALC_FOUND_ROWS ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT 0,".MAX_ITEM_INDEXRESULTS."";

			$result = $dbObj->query($sql);

			if ($result) {

				$sqlFoundRows = "SELECT FOUND_ROWS()";
				$resultFoundRows = $dbObj->query($sqlFoundRows);
				$foundRows = mysql_fetch_row($resultFoundRows);
				$articles = $foundRows[0];

				if ($articles > 0) {
					if ($this_items == 0) {
						if ($keyword) echo $message_search_for;
						else echo $message_browse_section;
					}
					$this_items += $articles;
					?><p class="generalResults"><a href="<?=MOBILE_DEFAULT_URL?>/articleresults.php<?=(($query_string_mobile) ? ("?".$query_string_mobile) : (""))?>"><?=system_showText(LANG_MENU_ARTICLE);?><span> (<?=$articles?>)</span></a></p><?
					while ($article = mysql_fetch_assoc($result)) {
						include("./articleview.php");
					}
					if ($articles > MAX_ITEM_INDEXRESULTS) {
						?><p class="moreResults"><a href="<?=MOBILE_DEFAULT_URL?>/articleresults.php<?=(($query_string_mobile) ? ("?".$query_string_mobile) : (""))?>"><?=system_showText(LANG_LABEL_MOREARTICLES);?></a></p><?
					}
				}

			}

		}
		####################################################################################################

	}

	if (!$this_items) {
		if ($keyword) {
			echo $message_search_for;
			echo "<p class=\"warning\">".system_showText(LANG_MSG_NO_RESULTS_FOUND)."</p>";
		} else {
			echo  "<p class=\"warning\">".system_showText(LANG_MSG_LEASTONEPARAMETER)."</p>";
		}
		include("./search.php");
	}

	?>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MOBILE_EDIRECTORY_ROOT."/layout/footer.php");
?>
