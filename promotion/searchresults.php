<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /promotion/results.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

?>

	<?
	if ($promotions) {
		echo "<div id='resultsMap' name='resultsMapHere' class='resultsMap'>&nbsp;</div>";
	}
	?>

	<div class="itemSearchResults">

		<?
		$user = true;
		$langIndex = language_getIndex(EDIR_LANGUAGE);
		$str_search = "";
		if ($keyword) $str_search .= " ".system_showText(LANG_SEARCHRESULTS_KEYWORD)." <strong>".$keyword."</strong>";
		if ($where) $str_search .= " ".system_showText(LANG_SEARCHRESULTS_WHERE)." <strong>".$where."</strong>";
		if ($category_id) {
			$search_category = new ListingCategory($category_id);
			if ($search_category->getString("title".$langIndex)) {
				$str_search .= " ".system_showText(LANG_SEARCHRESULTS_INCATEGORY)." <strong>".$search_category->getString("title".$langIndex)."</strong>";
			}
		}
		if ($cidade_id || $bairro_id) $str_search.= " ".system_showText(LANG_SEARCHRESULTS_LOCATION)." ";
		if ($bairro_id) {
			$search_city = new LocationRegion($bairro_id);
			$str_search .= "<strong>".$search_city->getString("name")."</strong>";
		}
		if ($cidade_id && $bairro_id) $str_search.= ", ";
		if ($cidade_id) {
			$search_state = new LocationState($cidade_id);
			$str_search .= "<strong>".$search_state->getString("name")."</strong>";
		}
		if ($zip) {
			$str_search .= " ".system_showText(LANG_SEARCHRESULTS_ZIP)." ".ZIPCODE_LABEL." <strong>".$zip.(($dist)?(" (".$dist." ".ZIPCODE_UNIT_LABEL_PLURAL.")"):(""))."</strong>";
		}
		if (!$promotions) {
			if ($search_lock) {
				echo "<p class=\"errorMessage\">".system_showText(LANG_MSG_LEASTONEPARAMETER)."</p>";
			} else {
				$db = db_getDBObject();
				if($db->getRowCountSQL("SELECT COUNT(*) as total FROM Listing, Promotion WHERE Listing.promotion_id = Promotion.id;") > 0){
					if ($str_search) {
						?><p class="standardSubTitle"><?=system_showText(LANG_SEARCHRESULTS)?> <?=$str_search?></p><?
					}
					?><p class="errorMessage"><?=system_showText(LANG_MSG_NORESULTS);?> <?=system_showText(LANG_MSG_TRYAGAIN);?></p><?
					if ($keyword) {
						?><div class="response-msg inf ui-corner-all"><?=system_showText(LANG_MSG_USE_SPECIFIC_KEYWORD);?></div><?
					}
				} else {
					?><div class="response-msg inf ui-corner-all"><?=system_showText(LANG_MSG_NOPROMOTIONS);?></div><?
				}
			}
		} elseif ($promotions){
			echo "<h3 class=\"standardTitle\">".system_showText(system_highlightLastWord(LANG_MSG_PROMOTIONRESULTS))."</h3><br class=\"clear\">";
			if ($str_search) {
				?><p class="standardSubTitle"><?=system_showText(LANG_SEARCHRESULTS)?> <?=$str_search?></p><?
			}
			include(EDIRECTORY_ROOT."/frontend/paging.php");
			$mapNumber = 1;
			foreach ($promotions as $promotion) {
				include(INCLUDES_DIR."/views/view_listing_promotion.php");
				$mapNumber++;
			}
			echo "<div class=\"summaryBottom\"></div>";
			include(EDIRECTORY_ROOT."/frontend/paging.php");
		}
		?>

	</div>