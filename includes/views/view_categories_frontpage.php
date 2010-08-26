<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_categories_frontpage.php
	# ----------------------------------------------------------------------------------------------------

	$left_categories_content = "";
	$right_categories_content = "";

	unset($catObj);
	$catObj = new ListingCategory();

	unset($categories);
	if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
		$dbCatObj = db_getDBObJect();
		$sql = "SELECT * FROM ListingCategory WHERE category_id = '0' ORDER BY active_listing DESC LIMIT 20";
		$result = $dbCatObj->query($sql);
		$categories = false;
		while ($row = mysql_fetch_assoc($result)) $categories[] = $row;
		unset($dbCatObj);
	} else {
		$categories = $catObj->retrieveAllCategories();
	}

	unset($categories_content);

	$total = 0;

	if ($categories) {

		for ($i=0; $i<count($categories); $i++) {

			$code_include = "";
			$count_this_category = 0;

				if (MODREWRITE_FEATURE == "on") {
					$code_include .= "<hr><h1 class=\"listingCATEGORIEStitle\"><a href=\"".LISTING_DEFAULT_URL."/guide/".$categories[$i]["friendly_url"]."\">";
				} else {
					$code_include .= "<hr><h1 class=\"listingCATEGORIEStitle\"><a href=\"".LISTING_DEFAULT_URL."/results.php?category_id=".$categories[$i]["id"]."\">";
				}

					$code_include .= $categories[$i]["title"];

					if (SHOW_CATEGORY_COUNT == "on") $code_include .= " <span>(".$categories[$i]["active_listing"].")</span>";

				$code_include .= "</a></h1>";

			$total++;
			$count_this_category++;

			if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {

				unset($subcategories);
				$subcategories = $catObj->retrieveAllSubCatById($categories[$i]["id"]);

				if ($subcategories) {

					unset($code_include_aux);

					for ($j=0; $j<count($subcategories); $j++) {

						$auxStr = "";

							if (MODREWRITE_FEATURE == "on") {
								$auxStr .= "<h2><a href=\"".LISTING_DEFAULT_URL."/guide/".$categories[$i]["friendly_url"]."/".$subcategories[$j]["friendly_url"]."\">";
							} else {
								$auxStr .= "<h2><a href=\"".LISTING_DEFAULT_URL."/results.php?category_id=" . $subcategories[$j]["id"] . "\">";
							}

								$auxStr .= $subcategories[$j]["title"];

								if (SHOW_CATEGORY_COUNT == "on") $auxStr .= " (".$subcategories[$j]["active_listing"].")";

							$auxStr .= "</a></h2>";

						$code_include_aux[$j] = $auxStr;

						$total++;
						$count_this_category++;

					}

					$code_include .= implode($code_include_aux);

				}

			}

			$categories_content[$i]["content"] = $code_include;
			$categories_content[$i]["count"] = $count_this_category;

		}

	}

	if ($categories_content) {

		$left_categories_content = "";
		$right_categories_content = "";
		$division = ceil($total / 2);
		$aux = 0;

		foreach ($categories_content as $category_content) {

			if ($aux < $division) {
				$left_categories_content .= $category_content["content"];
			} else {
				$right_categories_content .= $category_content["content"];
			}

			$aux += $category_content["count"];

		}

	}

?>

<? if ($left_categories_content || $right_categories_content) { ?>

	<p class="standardTitle">Browse by <span>Category</span></p>
	<div class="listingCATEGORIES">
			<blockquote class="allCategories">
				<?
				$catObj = new ListingCategory();
				$categories = $catObj->retrieveAllCategories();
				if ($categories) {
					for ($i=0; $i<count($categories); $i++) {
						echo "<h1 class=\"listingCATEGORIEStitle\">";
						if (MODREWRITE_FEATURE == "on") {
							echo "<a href=\"".LISTING_DEFAULT_URL."/guide/".$categories[$i]["friendly_url"]."\">";
						} else {
							echo "<a href=\"".LISTING_DEFAULT_URL."/results.php?category_id=".$categories[$i]["id"]."\">";
						}
						echo $categories[$i]["title"];
						if (SHOW_CATEGORY_COUNT == "on") {
							echo " <span>(".$categories[$i]["active_listing"].")</span>";
						}
						echo "</a>";
						echo "</h1>";
					}
				}
				?>
			</blockquote>
		</div>

<? } ?>
