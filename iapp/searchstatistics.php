<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /iapp/searchstatistics.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	echo "<p class=\"searchResults\">";
	echo "Found <strong>".$item_total_amount."</strong> record".(($item_total_amount==1) ? ("") : ("s"))."";
	if ($item_total_amount > MAX_ITEM_PER_PAGE) {
		echo " | Page <strong>".$page."</strong> of <strong>".ceil($item_total_amount/MAX_ITEM_PER_PAGE)."</strong> pages";
	}
	echo "</p>";

?>
