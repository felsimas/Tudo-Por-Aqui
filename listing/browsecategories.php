<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /listing/browsecategories.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$category_list = "";
	if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
		$sql = "SELECT * FROM ListingCategory WHERE category_id = '0' ORDER BY active_listing DESC LIMIT 20";
		$categories = db_getFromDBBySQL("listingcategory", $sql);
	} else {
		$categories = db_getFromDB("listingcategory", "category_id", 0, "all", "title");
	}

	if ($categories) {

		foreach ($categories as $category) {

			$category_list .= "<li class=\"left-listTITLE\">";

				if (MODREWRITE_FEATURE == "on") {
					$category_list .= "<h1><a href=\"".LISTING_DEFAULT_URL."/guide/".$category->getString("friendly_url")."\">";
				} else {
					$category_list .= "<h1><a href=\"".LISTING_DEFAULT_URL."/results.php?category_id=".$category->getNumber("id")."\">";
				}

					$category_list .= $category->getString("title");

					if (SHOW_CATEGORY_COUNT == "on") $category_list .= " (".$category->getNumber("active_listing").")";

				$category_list .= "</a></h1>";

			$category_list .= "</li>";

			if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {

				$subcategories = db_getFromDB("listingcategory", "category_id", $category->getNumber("id"), "all", "title");

				if ($subcategories) {

					foreach ($subcategories as $subcategory) {

						$category_list .= "<li style=\"margin-left:10px\">";

							if (MODREWRITE_FEATURE == "on") {
								$category_list .= "<h2><a href=\"".LISTING_DEFAULT_URL."/guide/".$category->getString("friendly_url")."/".$subcategory->getString("friendly_url")."\">";
							} else {
								$category_list .= "<h2><a href=\"".LISTING_DEFAULT_URL."/results.php?category_id=".$subcategory->getNumber("id")."\">";
							}

								$category_list .= $subcategory->getString("title");

								if (SHOW_CATEGORY_COUNT == "on") $category_list .= " (".$subcategory->getNumber("active_listing").")";

							$category_list .= "</a></h2>";

						$category_list .= "</li>";

					}

				}

			}

		}

	}

	if ($category_list) {
		?>
		<p class="standardTitle">Browse by <span>Category</span></p>
		<ul class="left-list">
			<?=$category_list?>
		</ul>
		<? if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") { ?>
			<p class="viewAllCategories"><a href="<?=LISTING_DEFAULT_URL?>/allcategories.php">View all categories &raquo;</a></p>
		<? } ?>
		<?
	}

?>
