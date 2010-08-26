<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /listing/allcategoriescontent.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

?>

	<p class="standardTitle"><?=system_showText(system_highlightLastWord(LANG_BROWSEBYCATEGORY))?></p>
	<div class="categories">
		<div class="allCategories">
			<?
			$left_categories_content  = "";
			$right_categories_content = "";
			
			$catObj = new ListingCategory();
			$categories = $catObj->retrieveAllCategories(EDIR_LANGUAGE);
			$langIndex = language_getIndex(EDIR_LANGUAGE);
			
			unset($categories_content);
			$total = 0;
			if ($categories) {
				for ($i=0; $i<count($categories); $i++) {
					$code_include = "<h3>";
					if (MODREWRITE_FEATURE == "on") {
						$code_include .= "<a href=\"".LISTING_DEFAULT_URL."/guide/".$categories[$i]["friendly_url".$langIndex]."\">";
					} else {
						$code_include .= "<a href=\"".LISTING_DEFAULT_URL."/results.php?category_id=".$categories[$i]["id"]."\">";
					}
					$code_include .= $categories[$i]["title".$langIndex];
					if (SHOW_CATEGORY_COUNT == "on") {
						$code_include .= " <span class=\"complementaryInfo\">(".$categories[$i]["active_listing"].")</span>";
					}
					$code_include .= "</a>";
					$code_include .= "</h3>";
					
					$categories_content[$i]["content"] = $code_include;
					$total++;
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
						$aux++;
					}
				}
			}
						
			?>
			<div class="categoriesColumn"><?=$left_categories_content?></div>
			<div class="categoriesColumn categoriesRightColumn"><?=$right_categories_content?></div>
		</div>
	</div>
