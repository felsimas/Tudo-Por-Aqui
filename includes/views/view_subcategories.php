<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_subcategories.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if ($category_id) {

		unset($catObj);
		$catObj = new ListingCategory($category_id);
		$subcategories = $catObj->retrieveAllSubCatById($category_id);
		$num_cols = 3;

		$catObj = new ListingCategory($category_id);
		$path_elem_arr = $catObj->getFullPath();

		if ($subcategories) $categories_content = "<table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"><tr>";

		if (MODREWRITE_FEATURE == "on") {

			$href = "";
			if ($path_elem_arr) foreach ($path_elem_arr as $each_category) {
				$friendly_url_path[] = $each_category["friendly_url"];
			}

			$href = LISTING_DEFAULT_URL."/guide/".implode("/",$friendly_url_path);

			if ($subcategories) for ($j = 0; $j < count($subcategories); $j++) {
				if(($j%$num_cols) == 0 && $j != 0) $categories_content .= "</tr><tr>";
				$categories_content .= "<td>&bull; <h2><a href=\"$href/".$subcategories[$j]["friendly_url"]."\">".$subcategories[$j]["title"];
				if (SHOW_CATEGORY_COUNT == "on") $categories_content .= " (".$subcategories[$j]["active_listing"].")";
				$categories_content .= "</a></h2></td>";
			}

		} else {

			if ($subcategories) for ($j = 0; $j < count($subcategories); $j++) {
				if (($j%$num_cols) == 0 && $j != 0) $categories_content .= "</tr><tr>";
				$categories_content .= "<h2><a href=\"".LISTING_DEFAULT_URL."/results.php?category_id=".$subcategories[$j]["id"]."\">".$subcategories[$j]["title"].((SHOW_CATEGORY_COUNT=="on")?(" (".$subcategories[$j]["active_listing"].")"):(""))."</a></h2>";
			}

		}

		if($subcategories) $categories_content .= "</tr></table>";

		?>

		<p class="standardTitle">Browse by <span>Category</span></p>

		<div class="listingCATEGORIES">

			<div class="base-subcategoriesRESULTS">

				<h1><img src="<?=DEFAULT_URL?>/images/design/bullet_listingSubCAT.gif" alt="bullet" /> <?=$catObj->getString('title').((SHOW_CATEGORY_COUNT=="on")?(" (".$catObj->getNumber("active_listing").")"):("")); ?></h1>

				<? if($catObj->getString('description')) { ?>
					<div class="summary-content"><?=$catObj->getString('description'); ?></div>
				<? } ?>

				<? if($categories_content) { ?>
					<p class="categoriesSubtitle">Subcategories:</p>
					<?=$categories_content?>
				<? } ?>

			</div>

			<br class="clear" /><br class="clear" />

		</div>

		<br />

		<?

	}

?>
