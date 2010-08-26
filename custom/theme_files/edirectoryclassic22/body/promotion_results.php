<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /body/promotion_results.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="sidebar">
		<? include(PROMOTION_EDIRECTORY_ROOT."/join.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/googleads.php"); ?>
	</div>

	<div class="mainContent">
		<? include(EDIRECTORY_ROOT."/frontend/breadcrumb.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/sitecontent_top.php"); ?>
		<? include(PROMOTION_EDIRECTORY_ROOT."/relatedcategories.php"); ?>
		<? include(PROMOTION_EDIRECTORY_ROOT."/searchresults.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/sitecontent_bottom.php"); ?>
	</div>
	
	<div class="sidebar">
		<div class="baseBannerFeatured"><? include(EDIRECTORY_ROOT."/frontend/banner_featured.php"); ?></div>
		<div class="baseSponsoredLinks"><? include(EDIRECTORY_ROOT."/frontend/banner_sponsoredlinks.php"); ?></div>
	</div>