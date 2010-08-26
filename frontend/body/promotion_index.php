<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /frontend/body/promotion_index.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="mainContent">
		<? include(EDIRECTORY_ROOT."/frontend/breadcrumb.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/sitecontent_top.php"); ?>
		<? include(PROMOTION_EDIRECTORY_ROOT."/featured.php"); ?>
		<? include(PROMOTION_EDIRECTORY_ROOT."/categories.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/sitecontent_bottom.php"); ?>
	</div>

	<div class="sidebar">
		<? include(PROMOTION_EDIRECTORY_ROOT."/quicklist.php"); ?>
		<? include(PROMOTION_EDIRECTORY_ROOT."/locations.php"); ?>
	</div>

	<div class="sidebar">
		<? include(EDIRECTORY_ROOT."/frontend/banner_featured.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/banner_sponsoredlinks.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/googleads.php"); ?>
	</div>
