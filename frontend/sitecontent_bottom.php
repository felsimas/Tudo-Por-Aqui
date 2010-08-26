<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /frontend/featured_listing.php
	# ----------------------------------------------------------------------------------------------------

	$contentObj = new Content("", EDIR_LANGUAGE);
	$content = $contentObj->retrieveContentByType($sitecontentSection." Bottom");
	if ($content) {
		echo "<blockquote>";
			echo "<div class=\"dynamicContent\">".$content."</div>";
		echo "</blockquote>";
	}

?>
