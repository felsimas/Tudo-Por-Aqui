<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /frontend/featured_event.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE == "on") {

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$numberOfEvents = 5;

	$sql = "SELECT value FROM EventLevel WHERE detail = 'y' ORDER BY value DESC LIMIT 1";
	$dbObj = db_getDBObject();
	$result = $dbObj->query($sql);
	$row = mysql_fetch_assoc($result);
	$level = $row["value"];

	if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontEventSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." Event.level = ".$level." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT ".$numberOfEvents."";
		$array_events = db_getFromDBBySQL("event", $sql);
	}

	$currentEvent = 1;

	if ($array_events) {


		echo "<div class=\"featuredItems\">";

			foreach ($array_events as $event) {

				report_newRecord("event", $event->getString("id"), EVENT_REPORT_SUMMARY_VIEW);

				if (MODREWRITE_FEATURE == "on") {
					$detailLink = "".EVENT_DEFAULT_URL."/".$event->getString("friendly_url").".html";
				} else {
					$detailLink = "".EVENT_DEFAULT_URL."/detail.php?id=".$event->getNumber("id")."";
				}

				if ($currentEvent == 1) {
					echo "<div id=\"featured\">
						<div class=\"box-t1\">
							<div class=\"box-t2\">
								<div class=\"box-t3\"/>
								</div>
							</div>
						</div>";
					echo "<div class=\"box-1\"><div class=\"box-2\"><div class=\"box-3\"><div class=\"highlightBox\">";
					echo "<h2 class=\"standardTitle\">".system_showText(system_highlightLastWord(LANG_UPCOMING_EVENT))."</h2>";
					
					echo "<span class=\"highlightLabel\">".system_showText(LANG_ITEM_FEATURED)."</span>";
					echo "<div class=\"highlightImage\">";
					$imageObj = new Image($event->getNumber("thumb_id"));
					if ($imageObj->imageExists()) {
						echo "<a href=\"".$detailLink."\" class=\"featuredEventImage\">";
						echo $imageObj->getTag(true, IMAGE_FRONT_EVENT_WIDTH, IMAGE_FRONT_EVENT_HEIGHT, $event->getString("title"), true);
						echo "</a>";
					} else {
						echo "<a href=\"".$detailLink."\" class=\"featuredEventImage noimage\" style=\"".system_getNoImageStyle()."\">";
						echo "&nbsp;";
						echo "</a>";
					}
					echo "</div>";
					echo "<h3><a href=\"".$detailLink."\">".$event->getString("title")."</a></h3>";
					$str_date = $event->getDateString();
					$str_time = $event->getTimeString();
					echo "<p class=\"complementaryInfo\">".$str_date."<br />".$str_time."</p>";
					echo "</div></div></div></div>";
					echo "<div class=\"box-b1\">
						<div class=\"box-b2\">
							<div class=\"box-b3\"/>
							</div>
						</div>
					</div></div>";
					
				} else {
					echo "<div class=\"featured\">";
					echo "<h3><a href=\"".$detailLink."\">".$event->getString("title")."</a></h3>";
					$str_date = $event->getDateString();
					$str_time = $event->getTimeString();
					echo "<p class=\"complementaryInfo\">".$str_date."<br />".$str_time."</p>";
					echo "</div>\n\n";
				}

				$currentEvent++;

			}

		echo "</div><br/>";

	}

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	}

?>
