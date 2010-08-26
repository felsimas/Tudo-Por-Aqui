<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /body/article_detail.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="sidebar">
		<? include(ARTICLE_EDIRECTORY_ROOT."/join.php"); ?>
		<div class="baseBannerFeatured"><? include(EDIRECTORY_ROOT."/frontend/banner_featured.php"); ?></div>
		<div class="baseSponsoredLinks"><? include(EDIRECTORY_ROOT."/frontend/banner_sponsoredlinks.php"); ?></div>
		<? include(EDIRECTORY_ROOT."/frontend/googleads.php"); ?>
	</div>

	<div class="mainContent">
		<? include(EDIRECTORY_ROOT."/frontend/breadcrumb.php"); ?>
		<? include(ARTICLE_EDIRECTORY_ROOT."/detailview.php"); ?>
	</div>