<?


	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if (!$listingMsg) {
		$user = true;
		include(INCLUDES_DIR."/views/view_listing_detail.php");
	} else {
		echo "<p class=\"$message_style\">".$listingMsg."</p>";
	}

?>
