<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /body/event_index.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="sidebar">
		<? include(EVENT_EDIRECTORY_ROOT."/join.php"); ?>
		<? include(EVENT_EDIRECTORY_ROOT."/quicklist.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/googleads.php"); ?>
	</div>

	<div class="mainContent">
		<? include(EDIRECTORY_ROOT."/frontend/breadcrumb.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/sitecontent_top.php"); ?>
		<? include(EVENT_EDIRECTORY_ROOT."/categories.php"); ?>
		<? include(EVENT_EDIRECTORY_ROOT."/featured.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/sitecontent_bottom.php"); ?>
	</div>

	<div class="sidebar">
		<? include(EDIRECTORY_ROOT."/frontend/event_calendar.php"); ?>
		<div class="baseBannerFeatured"><? include(EDIRECTORY_ROOT."/frontend/banner_featured.php"); ?></div>
		<div class="baseSponsoredLinks"><? include(EDIRECTORY_ROOT."/frontend/banner_sponsoredlinks.php"); ?></div>
	</div>
