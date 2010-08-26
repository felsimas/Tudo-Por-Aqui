<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /listing/relatedcategories.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	unset($related_categories);
	unset($category_tree);

	if ($keyword) {

		$search_for_keyword = str_replace("\\", "", $keyword);
		$search_for_keyword_fields[] = "title";
		$search_for_keyword_fields[] = "title1";
		$search_for_keyword_fields[] = "title2";
		$search_for_keyword_fields[] = "title3";
		$search_for_keyword_fields[] = "title4";
		$search_for_keyword_fields[] = "keywords";
		$search_for_keyword_fields[] = "keywords1";
		$search_for_keyword_fields[] = "keywords2";
		$search_for_keyword_fields[] = "keywords3";
		$search_for_keyword_fields[] = "keywords4";
		$where_clause = search_getSQLFullTextSearch($search_for_keyword, $search_for_keyword_fields, "keyword_score", $order_by_keyword_score, "anyword");

		if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
			$sql = "SELECT * FROM ListingCategory WHERE category_id = 0 AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND ".$where_clause."";
		} else {
			$sql = "SELECT * FROM ListingCategory WHERE lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND ".$where_clause."";
		}

		unset($search_for_keyword);
		unset($search_for_keyword_fields);
		unset($order_by_keyword_score);
		unset($where_clause);

		$dbObj = db_getDBObject();
		$rs = $dbObj->query($sql);
		while ($row = mysql_fetch_assoc($rs)) {
			$related_categories[] = new ListingCategory($row["id"]);
		}

	}

	if ($related_categories) {
		foreach ($related_categories as $categoryObj) $arr_full_path[] = $categoryObj->getFullPath();
		$category_tree = system_generateCategoryTree($related_categories, $arr_full_path, "listing", $user, EDIR_LANGUAGE);
	}

?>

<? if ($related_categories && $category_tree) { ?>
	<div class="categoriesTreeRESULTS">
		<p class="relatedCategoriesTitle"><?=system_showText(LANG_RELATEDCATEGORIES)?>:</p>
		<div class="relatedCategoriesBase">
			<?=$category_tree?>
		</div>
	</div>
<? } ?>
