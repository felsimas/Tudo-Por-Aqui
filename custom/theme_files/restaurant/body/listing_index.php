<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /body/listing_index.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="mainContent">
		<? include(EDIRECTORY_ROOT."/frontend/breadcrumb.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/sitecontent_top.php"); ?>
		<? include(LISTING_EDIRECTORY_ROOT."/featured.php"); ?>
		<? include(LISTING_EDIRECTORY_ROOT."/categories.php"); ?>
        <? include(EDIRECTORY_ROOT."/frontend/featured_listing_review.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/sitecontent_bottom.php"); ?>
	</div>

	<div class="sidebar">
		<? include(LISTING_EDIRECTORY_ROOT."/quicklist.php"); ?>
		<? include(LISTING_EDIRECTORY_ROOT."/locations.php"); ?>
	</div>

	<div class="sidebar">
		<? include(LISTING_EDIRECTORY_ROOT."/join.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/banner_featured.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/banner_sponsoredlinks.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/googleads.php"); ?>
	</div>
