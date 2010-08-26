<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /frontend/featured_promotion.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$numberOfCols = 4;

	$levelObj = new ListingLevel();
	$levels = $levelObj->getLevelValues();
	foreach ($levels as $each_level) {
		if ($levelObj->getHasPromotion($each_level) == "y") {
			$allowed_levels[] = $each_level;
		}
	}
	$search_levels = ($allowed_levels ? implode(",", $allowed_levels) : "0");

	unset($searchReturn);
	$searchReturn = search_frontPromotionsearch($_GET, "random");
	$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT ".$numberOfCols."";
	$front_featured_promotions = db_getFromDBBySQL("promotion", $sql);

	if ($front_featured_promotions) {

		?>
		<h2 class="standardTitle"><?=system_showText(system_highlightLastWord(LANG_FEATURED_PROMOTION));?></h2>
		<div class="featuredItems">
			<?

			$first_front_featured_promotions = true;

			foreach ($front_featured_promotions as $promotion) {

				$promotion_link = "javascript:window.open('".PROMOTION_DEFAULT_URL."/promotion.php?id=".$promotion->getNumber("id")."', 'popup','toolbar=0,location=0,directories=0,status=0,width=".(IMAGE_PROMOTION_FULL_WIDTH+100).",height=".(IMAGE_PROMOTION_FULL_HEIGHT+100).",screenX=0,screenY=0,menubar=0,scrollbars=no,resizable=0');";

				echo "<div class=\"featured featuredPromotion\">";

				$imageObj = new Image($promotion->getNumber("thumb_id"));
				if ($imageObj->imageExists()) {
					echo "<a href=\"javascript:void(0);\" onclick=\"".$promotion_link."\" class=\"featuredPromotionImage\">";
					echo $imageObj->getTag(true, IMAGE_FRONT_PROMOTION_WIDTH, IMAGE_FRONT_PROMOTION_HEIGHT, $promotion->getString("name"), true);
					echo "</a>";
				} else {
					echo "<a href=\"javascript:void(0);\" onclick=\"".$promotion_link."\" class=\"featuredPromotionImage noimage\" style=\"".system_getNoImageStyle()."\">";
					echo "&nbsp;";
					echo "</a>";
				}
				echo "<h3><a href=\"javascript:void(0);\" onclick=\"".$promotion_link."\">".((strlen($promotion->getString("name"))<=30)?($promotion->getString("name")):(substr($promotion->getString("name"), 0, 27)."..."))."</a></h3>";

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
					echo "<p class=\"complementaryInfo\">".system_showText(LANG_BY)." <a href=\"".$listing_link."\">".$listing->getString("title")."</a></p>";
				}

				echo "</div>\n\n";

			}

			?>
		</div>
		<?

	}

?>
