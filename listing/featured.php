<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /listing/featured.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$numberOfListings = 7;

	$sql = "SELECT value FROM ListingLevel WHERE detail = 'y' ORDER BY value DESC LIMIT 1";
	$dbObj = db_getDBObject();
	$result = $dbObj->query($sql);
	$row = mysql_fetch_assoc($result);
	$level = $row["value"];

	if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontListingSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." Listing.level = ".$level." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT ".$numberOfListings."";
		$random_listings = db_getFromDBBySQL("listing", $sql);
	}

	if ($random_listings) {
		$top_featured_listing = "";
		$featured_listing = "";
		?>

	<!--	<h2 class="standardTitle"><?=system_highlightLastWord(LANG_FEATURED_LISTING)?></h2> !-->
		<div class="featuredItems">

			<?
			$user = true;
			$count = 0;
			foreach ($random_listings as $listing) {

				report_newRecord("listing", $listing->getString("id"), LISTING_REPORT_SUMMARY_VIEW);

				if (MODREWRITE_FEATURE == "on") {
					$detailLink = "".LISTING_DEFAULT_URL."/".$listing->getString("friendly_url").".html";
				} else {
					$detailLink = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing->getNumber("id")."";
				}

				if ($count < 2) {

					if ($count == 0) $top_featured_listing .= "<div class=\"divisor\">";

					$top_featured_listing .= "<div class=\"highlightImage\">";

					$imageObj = new Image($listing->getNumber("thumb_id"));
					if ($imageObj->imageExists()) {
						$top_featured_listing .= "<a href=\"".$detailLink."\" class=\"featuredListingImage\">";
						$top_featured_listing .= $imageObj->getTag(true, IMAGE_FRONT_LISTING_WIDTH, IMAGE_FRONT_LISTING_HEIGHT, $listing->getString("title"), true);
						$top_featured_listing .= "</a>";
					} else {
						$top_featured_listing .= "<a href=\"".$detailLink."\" class=\"featuredListingImage noimage\" style=\"".system_getNoImageStyle()."\">";
						$top_featured_listing .= "&nbsp;";
						$top_featured_listing .= "</a>";
					}

					$top_featured_listing .= "</div>";

					$top_featured_listing .= "<h3><a href=\"".$detailLink."\">".((strlen($listing->getString("title"))<=30)?($listing->getString("title")):(substr($listing->getString("title"), 0, 27)."..."))."</a></h3>";

					$top_featured_listing .= "<p class=\"complementaryInfo\">".system_itemRelatedCategories($listing->getNumber("id"), "listing", true)."</p>";

					$top_featured_listing .= "<p class=\"description\">".((strlen($listing->getStringLang(EDIR_LANGUAGE, "description"))<=100)?($listing->getStringLang(EDIR_LANGUAGE, "description")):(substr($listing->getStringLang(EDIR_LANGUAGE, "description"), 0, 97)."..."))."</p>";

					if ($count == 0) $top_featured_listing .= "</div>";

				} else {

					$featured_listing .= "<div class=\"featured".(($count < ($numberOfListings - 1)) ? " divisor" : "")."\">";

					$featured_listing .= "<h3><a href=\"".$detailLink."\">".((strlen($listing->getString("title"))<=30)?($listing->getString("title")):(substr($listing->getString("title"), 0, 27)."..."))."</a></h3>";

					$featured_listing .= "<p class=\"complementaryInfo\">".system_itemRelatedCategories($listing->getNumber("id"), "listing", true)."</p>\n\n";

					$featured_listing .= "</div>";

				}

				$count++;

			}
			?>
			<div id="featured">
				<div class="box-t1">
					<div class="box-t2">
						<div class="box-t3"/>
						</div>
					</div>
				</div>
			<div class="box-1"><div class="box-2"><div class="box-3">
				<div class="highlightBox">
				
			<span class="highlightLabel"><?=system_showText(LANG_ITEM_FEATURED);?></span>
			<?=$top_featured_listing?>
			</div>
				<div class="featuredColumn">
					
					<?=$featured_listing?>
				</div>
			</div></div></div>
		
			<div class="box-b1">
				<div class="box-b2">
					<div class="box-b3"/>
					</div>
				</div>
			</div>
			
			</div>
		

		</div>

		<?
	}

?>
