<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /promotion/categories.inc
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$left_categories_content = "";
	$right_categories_content = "";

	unset($catObj);
	$catObj = new ListingCategory();

	unset($categories);
	if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
		$dbCatObj = db_getDBObJect();
		$sql = "SELECT * FROM ListingCategory WHERE category_id = '0' AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." ORDER BY active_listing DESC LIMIT 20";
		$result = $dbCatObj->query($sql);
		$categories = false;
		while ($row = mysql_fetch_assoc($result)) $categories[] = $row;
		unset($dbCatObj);
	} else {
		$categories = $catObj->retrieveAllCategories(EDIR_LANGUAGE);
	}

	$langIndex = language_getIndex(EDIR_LANGUAGE);

	unset($categories_content);

	$total = 0;

	if ($categories) {

		for ($i=0; $i<count($categories); $i++) {

			$code_include = "";
			$count_this_category = 0;

				if (MODREWRITE_FEATURE == "on") {
					$code_include .= "<h3><a href=\"".PROMOTION_DEFAULT_URL."/guide/".$categories[$i]["friendly_url".$langIndex]."\">";
				} else {
					$code_include .= "<h3><a href=\"".PROMOTION_DEFAULT_URL."/results.php?category_id=".$categories[$i]["id"]."\">";
				}

					$code_include .= $categories[$i]["title".$langIndex];

				$code_include .= "</a></h3>";

			$total++;
			$count_this_category++;

			if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {

				unset($subcategories);
				$subcategories = $catObj->retrieveAllSubCatById($categories[$i]["id"], EDIR_LANGUAGE);

				if ($subcategories) {

					unset($code_include_aux);

					for ($j=0; $j<count($subcategories); $j++) {

						$auxStr = "";

							if (MODREWRITE_FEATURE == "on") {
								$auxStr .= "<a href=\"".PROMOTION_DEFAULT_URL."/guide/".$categories[$i]["friendly_url".$langIndex]."/".$subcategories[$j]["friendly_url".$langIndex]."\">";
							} else {
								$auxStr .= "<a href=\"".PROMOTION_DEFAULT_URL."/results.php?category_id=".$subcategories[$j]["id"]."\">";
							}

								$auxStr .= $subcategories[$j]["title".$langIndex];

							$auxStr .= "</a>";

						$code_include_aux[$j] = $auxStr;

						$total++;
						$count_this_category++;

					}

					$code_include .= "<p class=\"complementaryInfo\">".implode(", ", $code_include_aux)."</p>";

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

	<p class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_BROWSEBYCATEGORY))?></p>
	<div class="categories">
		<div class="categoriesColumn"><?=$left_categories_content?></div>
		<div class="categoriesColumn categoriesRightColumn"><?=$right_categories_content?></div>
		<? if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") { ?>
			<p class="viewAllCategories"><a href="<?=PROMOTION_DEFAULT_URL?>/allcategories.php"><?=system_showText(LANG_PROMOTION_VIEWALLCATEGORIES)?> &raquo;</a></p>
		<? } ?>
	</div>

<? } ?>
