<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /promotion/featured.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$numberOfPromotions = 6;

	$levelObj = new ListingLevel();
	$levels = $levelObj->getLevelValues();
	foreach ($levels as $each_level) {
		if ($levelObj->getHasPromotion($each_level) == "y") {
			$allowed_levels[] = $each_level;
		}
	}
	$search_levels = ($allowed_levels ? implode(",", $allowed_levels) : "0");

	unset($searchReturn);
	$searchReturn = search_frontPromotionSearch($_GET, "random");
	$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT ".($numberOfPromotions)."";
	$highlight_promotion = db_getFromDBBySQL("promotion", $sql);

	if ($highlight_promotion) {
		$top_featured_promotion = "";
		$featured_promotion = "";
		?>

		<h2 class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_FEATURED_PROMOTION))?></h2>
		<div class="featuredItems">

			<?
			$user = true;
			$count = 0;
			foreach ($highlight_promotion as $promotion) {

				$promotion_link = "javascript:window.open('".PROMOTION_DEFAULT_URL."/promotion.php?id=".$promotion->getNumber("id")."', 'popup', 'toolbar=0, location=0, directories=0, status=0, width=".(IMAGE_PROMOTION_FULL_WIDTH+100).", height=".(IMAGE_PROMOTION_FULL_HEIGHT+100).", screenX=0, screenY=0, menubar=0, scrollbars=no, resizable=0');";

				if ($count < 2) {

					if ($count == 0) $top_featured_promotion .= "<div class=\"divisor\">";

					$top_featured_promotion .= "<div class=\"highlightImage\">";

					$imageObj = new Image($promotion->getNumber("thumb_id"));
					if ($imageObj->imageExists()) {
						$top_featured_promotion .= "<a href=\"javascript:void(0);\" onclick=\"".$promotion_link."\" class=\"featuredPromotionImage\">";
						$top_featured_promotion .= $imageObj->getTag(true, IMAGE_FEATURED_PROMOTION_WIDTH, IMAGE_FEATURED_PROMOTION_HEIGHT, $promotion->getString("title"), true);
						$top_featured_promotion .= "</a>";
					} else {
						$top_featured_promotion .= "<a href=\"javascript:void(0);\" onclick=\"".$promotion_link."\" class=\"featuredPromotionImage noimage\" style=\"".system_getNoImageStyle()."\">";
						$top_featured_promotion .= "&nbsp;";
						$top_featured_promotion .= "</a>";
					}

					$top_featured_promotion .= "</div>";

					$top_featured_promotion .= "<h3><a href=\"javascript:void(0);\" onclick=\"".$promotion_link."\">".((strlen($promotion->getString("name"))<=30)?($promotion->getString("name")):(substr($promotion->getString("name"), 0, 27)."..."))."</a></h3>";

					$listingpromotion_string = "";
					$listing = db_getFromDB("listing", "promotion_id", db_formatNumber($promotion->getNumber("id")));
					if ($listing->getString("title")) {
						$level = new ListingLevel();
						if ($level->getDetail($listing->getNumber("level")) == "y") {
							if (MODREWRITE_FEATURE == "on") {
								$listing_link = "".LISTING_DEFAULT_URL."/".$listing->getString("friendly_url").".html";
							} else {
								$listing_link = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing->getNumber("id")."";
							}
						} else {
							$listing_link = "".LISTING_DEFAULT_URL."/results.php?id=".$listing->getNumber("id");
						}
						$listingpromotion_string .= system_showText(LANG_BY)." <a href=\"".$listing_link."\">".$listing->getString("title")."</a>";
					}

					$top_featured_promotion .= "<p class=\"complementaryInfo\">".$listingpromotion_string."<br /> ".$promotion->getDate("start_date")." - ".$promotion->getDate("end_date")."</p>";

					$top_featured_promotion .= "<p class=\"description\">".((strlen($promotion->getStringLang(EDIR_LANGUAGE, "description"))<=100)?($promotion->getStringLang(EDIR_LANGUAGE, "description")):(substr($promotion->getStringLang(EDIR_LANGUAGE, "description"), 0, 97)."..."))."</p>";

					if ($count == 0) $top_featured_promotion .= "</div>";

				} else {

					$featured_promotion .= "<div class=\"featured".(($count < ($numberOfPromotions - 1)) ? " divisor" : "")."\">";

					$featured_promotion .= "<h3><a href=\"javascript:void(0);\" onclick=\"".$promotion_link."\">".((strlen($promotion->getString("name"))<=30)?($promotion->getString("name")):(substr($promotion->getString("name"), 0, 27)."..."))."</a></h3>";

					$listingpromotion_string = "";
					$listing = db_getFromDB("listing", "promotion_id", db_formatNumber($promotion->getNumber("id")));
					if ($listing->getString("title")) {
						$level = new ListingLevel();
						if ($level->getDetail($listing->getNumber("level")) == "y") {
							if (MODREWRITE_FEATURE == "on") {
								$listing_link = "".LISTING_DEFAULT_URL."/".$listing->getString("friendly_url").".html";
							} else {
								$listing_link = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing->getNumber("id")."";
							}
						} else {
							$listing_link = "".LISTING_DEFAULT_URL."/results.php?id=".$listing->getNumber("id");
						}
						$listingpromotion_string .= system_showText(LANG_BY)." <a href=\"".$listing_link."\">".$listing->getString("title")."</a>";
					}

					$featured_promotion .= "<p class=\"complementaryInfo\">".$listingpromotion_string."<br /> ".$promotion->getDate("start_date")." - ".$promotion->getDate("end_date")."</p>\n\n";

					$featured_promotion .= "</div>";

				}

				$count++;

			}
			?>

			<div class="highlightBox">
				<span class="highlightLabel"><?=system_showText(LANG_ITEM_FEATURED);?></span>
				<?=$top_featured_promotion?>
			</div>

			<div class="featuredColumn">
				<?=$featured_promotion?>
			</div>

		</div>

		<?
	}

?>
