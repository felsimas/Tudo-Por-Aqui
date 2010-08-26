<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/views/view_related_categories.php
	# ----------------------------------------------------------------------------------------------------

	// Related Categories ////////////////////////////////////
	if ($keyword) {
		if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") {
			$sql = "SELECT * FROM ListingCategory WHERE category_id = 0 AND MATCH (title, keywords) AGAINST (".db_formatString($keyword." ".$keyword."*")." IN BOOLEAN MODE)";
		} else {
			$sql = "SELECT * FROM ListingCategory WHERE MATCH (title, keywords) AGAINST (".db_formatString($keyword).")";
		}
		$dbObj = db_getDBObject();
		$rs = $dbObj->query($sql);
		while($row = mysql_fetch_assoc($rs)) {
			$related_categories[] = new ListingCategory($row["id"]);
		}
	}
	//////////////////////////////////////////////////////////

	if ($related_categories) {
		foreach ($related_categories as $categoryObj) $arr_full_path[] = $categoryObj->getFullPath();
		$category_tree = system_generateCategoryTree($related_categories, $arr_full_path, $user);
	}

?>

<? if ($category_tree) { ?>
	<div class="categoriesTreeRESULTS">
		<p class="relatedCategoriesTitle">Related Categories:</p>
		<blockquote class="relatedCategoriesBase">
			<?=$category_tree?>
		</blockquote>
		<blockquote>&nbsp;</blockquote>
	</div>
<? } ?>
