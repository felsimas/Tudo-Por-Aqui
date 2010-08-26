<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /event/results.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

?>

	<?
	if ($events) {
		echo "<div id='resultsMap' name='resultsMapHere' class='resultsMap'>&nbsp;</div>";
	}
	?>

	<div class="itemSearchResults">

		<?
		$user = true;
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		$str_search = "";
		if ($_GET["this_date"]) {
			$ts_time = mktime(0,0,0,(int)substr($_GET["this_date"],4,2),(int)substr($_GET["this_date"],6,2),(int)substr($_GET["this_date"],0,4));
		} else {
			$ts_time = mktime("0,0,0,".date("m,d,Y"));
		}
		if (!$_GET["month"]) $str_search = system_showText(LANG_SEARCHRESULTS_DATE)." <strong>".system_showDate(LANG_STRINGDATE_YEARANDMONTHANDDAY, $ts_time)."</strong>";
		else $str_search = system_showText(LANG_SEARCHRESULTS_DATE)." <strong>".system_showDate(LANG_STRINGDATE_YEARANDMONTH, $ts_time)."</strong>";
		if (!$_GET["month"] && !$_GET["this_date"]) {
			$str_search = "";
		}
		if ($keyword) $str_search .= " ".system_showText(LANG_SEARCHRESULTS_KEYWORD)." <strong>".$keyword."</strong>";
		if ($where) $str_search .= " ".system_showText(LANG_SEARCHRESULTS_WHERE)." <strong>".$where."</strong>";
		if ($category_id) {
			$search_category = new EventCategory($category_id);
			if ($search_category->getString("title".$langIndex)) {
				$str_search .= " ".system_showText(LANG_SEARCHRESULTS_INCATEGORY)." <strong>".$search_category->getString("title".$langIndex)."</strong>";
			}
		}
		if ($cidade_id || $bairro_id) $str_search.= " ".system_showText(LANG_SEARCHRESULTS_LOCATION)." ";
		if ($bairro_id) {
			$search_city = new LocationRegion($bairro_id);
			$str_search .= "<strong>".$search_city->getString("name")."</strong>";
		}
		if ($cidade_id && $bairro_id) $str_search.= ", ";
		if ($cidade_id) {
			$search_state = new LocationState($cidade_id);
			$str_search .= "<strong>".$search_state->getString("name")."</strong>";
		}
		if ($zip) {
			$str_search .= " ".system_showText(LANG_SEARCHRESULTS_ZIP)." ".ZIPCODE_LABEL." <strong>".$zip.(($dist)?(" (".$dist." ".ZIPCODE_UNIT_LABEL_PLURAL.")"):(""))."</strong>";
		}
		if (!$events) {
			if ($search_lock) {
				echo "<p class=\"errorMessage\">".system_showText(LANG_MSG_LEASTONEPARAMETER)."</p>";
			} else {
				$db = db_getDBObject();
				if ($db->getRowCount("Event") > 0) {
					if ($str_search) {
						?><p class="standardSubTitle"><?=system_showText(LANG_SEARCHRESULTS)?> <?=$str_search?></p><?
					}
					?><p class="errorMessage"><?=system_showText(LANG_MSG_NORESULTS);?> <?=system_showText(LANG_MSG_TRYAGAIN);?></p><?
					if ($keyword) {
						?><div class="response-msg inf ui-corner-all"><?=system_showText(LANG_MSG_USE_SPECIFIC_KEYWORD);?></div><?
					}
				} else {
					?><div class="response-msg inf ui-corner-all"><?=system_showText(LANG_MSG_NOEVENTS);?></div><?
				}
			}
		} elseif ($events){
			$itemRSSSection = "event";
			echo "<h3 class=\"standardTitle\">".system_showText(system_highlightLastWord(LANG_MSG_EVENTRESULTS));
			echo "<span class=\"complementaryInfo\">";
			include(INCLUDES_DIR."/code/rss.php");
			echo "</span></h3><br class=\"clear\">";
			if ($str_search) {
				?><p class="standardSubTitle"><?=system_showText(LANG_SEARCHRESULTS)?> <?=$str_search?></p><?
			}
			include(EDIRECTORY_ROOT."/frontend/paging.php");
			$level = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
			$locationManager =& new LocationManager();
			$mapNumber = 1;
			foreach ($events as $event) {
				$event->setLocationManager($locationManager);
				report_newRecord("event", $event->getString("id"), EVENT_REPORT_SUMMARY_VIEW);
				include(INCLUDES_DIR."/views/view_event_summary_".$event->getNumber("level").".php");
				if ((strlen(trim($event->getLocationString("A", true))) > 0) || (strlen(trim($event->getLocationString("s", true))) > 0) || (strlen(trim($event->getLocationString("r", true))) > 0)) {
					$mapNumber++;
				}
			}
			echo "<div class=\"summaryBottom\"></div>";
			include(EDIRECTORY_ROOT."/frontend/paging.php");
		}
		?>

	</div>