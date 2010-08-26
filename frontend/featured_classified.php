<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /frontend/featured_classified.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE == "on") {

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$numberOfCols = 4;

	$sql = "SELECT value FROM ClassifiedLevel WHERE detail = 'y' ORDER BY value DESC LIMIT 1";
	$dbObj = db_getDBObject();
	$result = $dbObj->query($sql);
	$row = mysql_fetch_assoc($result);
	$level = $row["value"];

	if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontClassifiedSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." Classified.level = ".$level." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT ".$numberOfCols."";
		$front_featured_classifieds = db_getFromDBBySQL("classified", $sql);
	}

	if ($front_featured_classifieds) {

		?>
		<h2 class="standardTitle"><?=system_showText(system_highlightLastWord(LANG_FEATURED_CLASSIFIED));?></h2>
		<div class="featuredItems">
			<?

			$first_front_featured_classifieds = true;

			foreach ($front_featured_classifieds as $classified) {

				report_newRecord("classified", $classified->getString("id"), CLASSIFIED_REPORT_SUMMARY_VIEW);

				if (MODREWRITE_FEATURE == "on") {
					$detailLink = "".CLASSIFIED_DEFAULT_URL."/".$classified->getString("friendly_url").".html";
				} else {
					$detailLink = "".CLASSIFIED_DEFAULT_URL."/detail.php?id=".$classified->getNumber("id")."";
				}

				echo "<div class=\"featured featuredClassified\">";

				$imageObj = new Image($classified->getNumber("thumb_id"));
				if ($imageObj->imageExists()) {
					echo "<a href=\"".$detailLink."\" class=\"featuredClassifiedImage\">";
					echo $imageObj->getTag(true, IMAGE_FRONT_CLASSIFIED_WIDTH, IMAGE_FRONT_CLASSIFIED_HEIGHT, $classified->getString("title"), true);
					echo "</a>";
				} else {
					echo "<a href=\"".$detailLink."\" class=\"featuredClassifiedImage noimage\" style=\"width: ".IMAGE_FRONT_CLASSIFIED_WIDTH."px; height: ".IMAGE_FRONT_CLASSIFIED_HEIGHT."px; ".system_getNoImageStyle()."\">";
					echo "&nbsp;";
					echo "</a>";
				}
				echo "<h3><a href=\"".$detailLink."\">".((strlen($classified->getString("title"))<=30)?($classified->getString("title")):(substr($classified->getString("title"), 0, 27)."..."))."</a></h3>";

				echo "<p class=\"complementaryInfo\">".system_itemRelatedCategories($classified->getNumber("id"), "classified", true)."</p>";

				echo "</div>\n\n";

			}

			?>
		</div>
		<?

	}

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	}

?>
