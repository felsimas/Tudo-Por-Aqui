<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /event/featured.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$numberOfEvents = 7;

	$sql = "SELECT value FROM EventLevel WHERE detail = 'y' ORDER BY value DESC LIMIT 1";
	$dbObj = db_getDBObject();
	$result = $dbObj->query($sql);
	$row = mysql_fetch_assoc($result);
	$level = $row["value"];

	if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontEventSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." Event.level = ".$level." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT ".$numberOfEvents."";
		$highlight_events = db_getFromDBBySQL("event", $sql);
	}

	if ($highlight_events) {
		$top_featured_event = "";
		$featured_event = "";
		?>
		<div id="featured">
			<div class="box-t1">
				<div class="box-t2">
					<div class="box-t3"/>
					</div>
				</div>
			</div>
		<div class="box-1"><div class="box-2"><div class="box-3">
		<h2 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_EVENT_FEATURED))?></h2>
		<div class="featuredItems">

			<?
			$user = true;
			$count = 0;
			foreach ($highlight_events as $event) {

				report_newRecord("event", $event->getString("id"), EVENT_REPORT_SUMMARY_VIEW);

				if (MODREWRITE_FEATURE == "on") {
					$detailLink = "".EVENT_DEFAULT_URL."/".$event->getString("friendly_url").".html";
				} else {
					$detailLink = "".EVENT_DEFAULT_URL."/detail.php?id=".$event->getNumber("id")."";
				}

				if ($count < 2) {

					if ($count == 0) $top_featured_event .= "<div class=\"divisor\">";

					$top_featured_event .= "<div class=\"highlightImage\">";

					$imageObj = new Image($event->getNumber("thumb_id"));
					if ($imageObj->imageExists()) {
						$top_featured_event .= "<a href=\"".$detailLink."\" class=\"featuredEventImage\">";
						$top_featured_event .= $imageObj->getTag(true, IMAGE_FEATURED_EVENT_WIDTH, IMAGE_FEATURED_EVENT_HEIGHT, $event->getString("title"), true);
						$top_featured_event .= "</a>";
					} else {
						$top_featured_event .= "<a href=\"".$detailLink."\" class=\"featuredEventImage noimage\" style=\"".system_getNoImageStyle()."\">";
						$top_featured_event .= "&nbsp;";
						$top_featured_event .= "</a>";
					}

					$top_featured_event .= "</div>";

					$top_featured_event .= "<h3><a href=\"".$detailLink."\">".((strlen($event->getString("title"))<=30)?($event->getString("title")):(substr($event->getString("title"), 0, 27)."..."))."</a></h3>";

					$str_date = $event->getDateString();
					$str_time = $event->getTimeString();
					$top_featured_event .= "<p class=\"complementaryInfo\">".$str_date."<br />".$str_time."</p>";

					$top_featured_event .= "<p class=\"description\">".((strlen($event->getStringLang(EDIR_LANGUAGE, "description"))<=100)?($event->getStringLang(EDIR_LANGUAGE, "description")):(substr($event->getStringLang(EDIR_LANGUAGE, "description"), 0, 97)."..."))."</p>";

					if ($count == 0) $top_featured_event .= "</div>";

				} else {

					$featured_event .= "<div class=\"featured".(($count < ($numberOfEvents - 1)) ? " divisor" : "")."\">";

					$featured_event .= "<h3><a href=\"".$detailLink."\">".((strlen($event->getString("title"))<=30)?($event->getString("title")):(substr($event->getString("title"), 0, 27)."..."))."</a></h3>";

					$str_date = $event->getDateString();
					$str_time = $event->getTimeString();
					$featured_event .= "<p class=\"complementaryInfo\">".$str_date."<br />".$str_time."</p>\n\n";

					$featured_event .= "</div>";

				}

				$count++;

			}
			?>

			<div class="highlightBox">
				<span class="highlightLabel"><?=system_showText(LANG_ITEM_FEATURED);?></span>
				<?=$top_featured_event?>
			</div>

			<div class="featuredColumn">
				<?=$featured_event?>
			</div>

		</div>
	</div></div></div>
		<div class="box-b1">
			<div class="box-b2">
				<div class="box-b3"/>
				</div>
			</div>
		</div>
		
		</div>
		<?
	}

?>
