<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /mobile/searchstatistics.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	echo "<p class=\"searchResults\">";
	echo "".(($item_total_amount==1) ? (system_showText(LANG_PAGING_FOUND)) : (system_showText(LANG_PAGING_FOUND_PLURAL)))." <span class=\"bold\">".$item_total_amount."</span> ".(($item_total_amount==1) ? (system_showText(LANG_PAGING_RECORD)) : (system_showText(LANG_PAGING_RECORD_PLURAL)))."";
	if ($item_total_amount > MAX_ITEM_PER_PAGE) {
		echo " | ".system_showText(LANG_PAGING_SHOWINGPAGE)." <span class=\"bold\">".$page."</span> ".system_showText(LANG_PAGING_PAGEOF)." <span class=\"bold\">".ceil($item_total_amount/MAX_ITEM_PER_PAGE)."</span> ".LANG_PAGING_PAGE_PLURAL."";
	}
	echo "</p>";

?>
