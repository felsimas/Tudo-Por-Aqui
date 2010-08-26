<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /frontend/featured_listing.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$numberOfCols = 4;

	$sql = "SELECT value FROM ListingLevel WHERE detail = 'y' ORDER BY value DESC LIMIT 1";
	$dbObj = db_getDBObject();
	$result = $dbObj->query($sql);
	$row = mysql_fetch_assoc($result);
	$level = $row["value"];

	if ($level) {
		unset($searchReturn);
		$searchReturn = search_frontListingSearch($_GET, "random");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." Listing.level = ".$level." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT ".$numberOfCols."";
		$front_featured_listings = db_getFromDBBySQL("listing", $sql);
	}

	if ($front_featured_listings) {

		?>
		<!-- <h2 class="standardTitle"><?=system_showText(system_highlightLastWord(LANG_FEATURED_LISTING));?></h2> !-->
		<div class="featuredItems">
			<?

			$first_front_featured_listings = true;

			$first_featured_listing = "";
			$featured_listing = "";
			$currentListing = 1;

			foreach ($front_featured_listings as $listing) {

				report_newRecord("listing", $listing->getString("id"), LISTING_REPORT_SUMMARY_VIEW);

				if (MODREWRITE_FEATURE == "on") {
					$detailLink = "".LISTING_DEFAULT_URL."/".$listing->getString("friendly_url").".html";
				} else {
					$detailLink = "".LISTING_DEFAULT_URL."/detail.php?id=".$listing->getNumber("id")."";
				}

				if ($currentListing == 1) {

					$first_featured_listing = "<div class=\"highlightImage\">";

					$imageObj = new Image($listing->getNumber("thumb_id"));
					if ($imageObj->imageExists()) {
						$first_featured_listing .= "<a href=\"".$detailLink."\" class=\"featuredListingImage\">";
						$first_featured_listing .= $imageObj->getTag(true, IMAGE_FRONT_LISTING_WIDTH, IMAGE_FRONT_LISTING_HEIGHT, $listing->getString("title"), true);
						$first_featured_listing .= "</a>";
					} else {
						$first_featured_listing .= "<a href=\"".$detailLink."\" class=\"featuredListingImage noimage\" style=\"".system_getNoImageStyle()."\">";
						$first_featured_listing .= "&nbsp;";
						$first_featured_listing .= "</a>";
					}

					$first_featured_listing .= "</div>";

					$first_featured_listing .= "<h3><a href=\"".$detailLink."\">".((strlen($listing->getString("title"))<=30)?($listing->getString("title")):(substr($listing->getString("title"), 0, 27)."..."))."</a></h3>";

					$first_featured_listing .= "<p class=\"complementaryInfo\">".system_itemRelatedCategories($listing->getNumber("id"), "listing", true)."</p>";

					$first_featured_listing .= "<p class=\"description\">".((strlen($listing->getStringLang(EDIR_LANGUAGE, "description"))<=100)?($listing->getStringLang(EDIR_LANGUAGE, "description")):(substr($listing->getStringLang(EDIR_LANGUAGE, "description"), 0, 97)."..."))."</p>";

				}	else {

					$featured_listing .= "<div class=\"featured".(($currentListing < $numberOfCols) ? " divisor" : "")."\">";

					$featured_listing .= "<h3><a href=\"".$detailLink."\">".((strlen($listing->getString("title"))<=30)?($listing->getString("title")):(substr($listing->getString("title"), 0, 27)."..."))."</a></h3>";

					$featured_listing .= "<p class=\"complementaryInfo\">".system_itemRelatedCategories($listing->getNumber("id"), "listing", true)."</p>";

					$featured_listing .= "</div>";

				}

				$currentListing++;

			}

			?>
			<div id="featured">
				<div class="box-t1">
					<div class="box-t2">
						<div class="box-t3"/>
						</div>
					</div>
				</div>
			<div class="box-1">
				<div class="box-2">
					<div class="box-3">
			<div class="highlightBox">
				<span class="highlightLabel"><?=system_showText(LANG_ITEM_FEATURED);?></span>
				<?=$first_featured_listing?>
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
