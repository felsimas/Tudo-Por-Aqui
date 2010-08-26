<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classified/featured.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$numberOfClassifieds = 8;

	$sql = "SELECT value FROM ClassifiedLevel WHERE detail = 'y' ORDER BY value DESC LIMIT 1";
	$dbObj = db_getDBObject();
	$result = $dbObj->query($sql);
	$row = mysql_fetch_assoc($result);
	$level = $row["value"];

	if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontClassifiedSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." Classified.level = ".$level." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT ".$numberOfClassifieds."";
		$highlight_classifieds = db_getFromDBBySQL("classified", $sql);
	}

	if ($highlight_classifieds) {
		$top_featured_classified = "";
		$featured_classified = "";
		?>

		<h2 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_FEATURED_CLASSIFIED))?></h2>
		<div class="featuredItems">

			<?
			$user = true;
			$count = 0;
			foreach ($highlight_classifieds as $classified) {

				report_newRecord("classified", $classified->getString("id"), CLASSIFIED_REPORT_SUMMARY_VIEW);

				if (MODREWRITE_FEATURE == "on") {
					$detailLink = "".CLASSIFIED_DEFAULT_URL."/".$classified->getString("friendly_url").".html";
				} else {
					$detailLink = "".CLASSIFIED_DEFAULT_URL."/detail.php?id=".$classified->getNumber("id")."";
				}

				if ($count < 2) {

					if ($count == 0) $top_featured_classified .= "<div class=\"divisor\">";

					$top_featured_classified .= "<div class=\"highlightImage\">";

					$imageObj = new Image($classified->getNumber("thumb_id"));
					if ($imageObj->imageExists()) {
						$top_featured_classified .= "<a href=\"".$detailLink."\" class=\"featuredClassifiedImage\">";
						$top_featured_classified .= $imageObj->getTag(true, IMAGE_FEATURED_CLASSIFIED_WIDTH, IMAGE_FEATURED_CLASSIFIED_HEIGHT, $classified->getString("title"), true);
						$top_featured_classified .= "</a>";
					} else {
						$top_featured_classified .= "<a href=\"".$detailLink."\" class=\"featuredClassifiedImage noimage\" style=\"".system_getNoImageStyle()."\">";
						$top_featured_classified .= "&nbsp;";
						$top_featured_classified .= "</a>";
					}

					$top_featured_classified .= "</div>";

					$top_featured_classified .= "<h3><a href=\"".$detailLink."\">".((strlen($classified->getString("title"))<=30)?($classified->getString("title")):(substr($classified->getString("title"), 0, 27)."..."))."</a></h3>";

					$top_featured_classified .= "<p class=\"complementaryInfo\">".system_itemRelatedCategories($classified->getNumber("id"), "classified", true)."</p>";

					$top_featured_classified .= "<p class=\"description\">".((strlen($classified->getStringLang(EDIR_LANGUAGE, "summarydesc"))<=100)?($classified->getStringLang(EDIR_LANGUAGE, "summarydesc")):(substr($classified->getStringLang(EDIR_LANGUAGE, "summarydesc"), 0, 97)."..."))."</p>";

					if ($count == 0) $top_featured_classified .= "</div>";

				} else {

					$featured_classified .= "<div class=\"featured".(($count < ($numberOfClassifieds - 1)) ? " divisor" : "")."\">";

					$featured_classified .= "<h3><a href=\"".$detailLink."\">".((strlen($classified->getString("title"))<=30)?($classified->getString("title")):(substr($classified->getString("title"), 0, 27)."..."))."</a></h3>";

					$featured_classified .= "<p class=\"complementaryInfo\">".system_itemRelatedCategories($classified->getNumber("id"), "classified", true)."</p>\n\n";

					$featured_classified .= "</div>";

				}

				$count++;

			}
			?>

			<div class="highlightBox">
				<span class="highlightLabel"><?=system_showText(LANG_ITEM_FEATURED);?></span>
				<?=$top_featured_classified?>
			</div>

			<div class="featuredColumn">
				<?=$featured_classified?>
			</div>

		</div>

		<?
	}

?>
