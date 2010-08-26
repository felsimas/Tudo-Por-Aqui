<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /listing/categories.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$left_categories_content  = "";
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
					$code_include .= "<h3><a href=\"".LISTING_DEFAULT_URL."/guide/".$categories[$i]["friendly_url".$langIndex]."\">";
				} else {
					$code_include .= "<h3><a href=\"".LISTING_DEFAULT_URL."/results.php?category_id=".$categories[$i]["id"]."\">";
				}

					$code_include .= $categories[$i]["title".$langIndex];

				$code_include .= "</a>";
				
				if (SHOW_CATEGORY_COUNT == "on") $code_include .= " <span class=\"complementaryInfo\">(".$categories[$i]["active_listing"].")</span>";
				
				$code_include .= "</h3>";

			$total++;
			$count_this_category++;
			
			if (strpos($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"], $_SERVER["SERVER_NAME"].EDIRECTORY_FOLDER."/index.php") === false) {

				if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION != "on") {
	
					unset($subcategories);
					$subcategories = $catObj->retrieveAllSubCatById($categories[$i]["id"], EDIR_LANGUAGE);
	
					if ($subcategories) {
	
						unset($code_include_aux);
	
						for ($j=0; $j<count($subcategories); $j++) {
	
							$auxStr = "";
	
								if (MODREWRITE_FEATURE == "on") {
									$auxStr .= "<a href=\"".LISTING_DEFAULT_URL."/guide/".$categories[$i]["friendly_url".$langIndex]."/".$subcategories[$j]["friendly_url".$langIndex]."\">";
								} else {
									$auxStr .= "<a href=\"".LISTING_DEFAULT_URL."/results.php?category_id=" . $subcategories[$j]["id"] . "\">";
								}
	
									$auxStr .= $subcategories[$j]["title".$langIndex];
	
									if (SHOW_CATEGORY_COUNT == "on") $auxStr .= " (".$subcategories[$j]["active_listing"].")";
	
								$auxStr .= "</a>";
	
							$code_include_aux[$j] = $auxStr;
	
							$total++;
							$count_this_category++;
	
						}
	
						$code_include .= "<p class=\"complementaryInfo\">".implode(", ", $code_include_aux)."</p>";
	
					}
	
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
	<div id="featured" style="margin-top:10px">
		<div class="box-t1">
			<div class="box-t2">
				<div class="box-t3"/>
				</div>
			</div>
		</div>
	<div class="box-1">	<div class="box-2">	<div class="box-3">
	<p class="standardTitle"><?=system_highlightLastWord(system_showText(LANG_BROWSEBYCATEGORY))?></p>
	<div class="categories">
		<div class="categoriesColumn"><?=$left_categories_content?></div>
		<div class="categoriesColumn categoriesRightColumn"><?=$right_categories_content?></div>
		<? if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") { ?>
			<p class="viewAllCategories"><a href="<?=LISTING_DEFAULT_URL?>/allcategories.php"><?=system_showText(LANG_LISTING_VIEWALLCATEGORIES)?> &raquo;</a></p>
		<? } ?>
	</div>
	</div></div></div>
		<div class="box-b1">
			<div class="box-b2">
				<div class="box-b3"/>
				</div>
			</div>
		</div>
		
		</div>

<? } ?>
