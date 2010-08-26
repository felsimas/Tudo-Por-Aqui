<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /frontend/body/article_index.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="mainContent">
		<? include(EDIRECTORY_ROOT."/frontend/breadcrumb.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/sitecontent_top.php"); ?>
		<? include(ARTICLE_EDIRECTORY_ROOT."/featured.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/featured_article_review.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/sitecontent_bottom.php"); ?>
	</div>

	<div class="sidebar">
		<? include(ARTICLE_EDIRECTORY_ROOT."/quicklist.php"); ?>
		<? include(ARTICLE_EDIRECTORY_ROOT."/categories.php"); ?>
	</div>

	<div class="sidebar_third">
		<? include(ARTICLE_EDIRECTORY_ROOT."/join.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/banner_featured.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/banner_sponsoredlinks.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/googleads.php"); ?>
	</div>
