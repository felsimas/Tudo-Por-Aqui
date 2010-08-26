<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /body/event_detail.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="sidebar">
		<? include(EVENT_EDIRECTORY_ROOT."/join.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/event_calendar.php"); ?>
		<div class="baseBannerFeatured"><? include(EDIRECTORY_ROOT."/frontend/banner_featured.php"); ?></div>
		<div class="baseSponsoredLinks"><? include(EDIRECTORY_ROOT."/frontend/banner_sponsoredlinks.php"); ?></div>
		<? include(EDIRECTORY_ROOT."/frontend/googleads.php"); ?>
	</div>

	<div class="mainContent">
		<? include(EDIRECTORY_ROOT."/frontend/breadcrumb.php"); ?>
		<? include(EVENT_EDIRECTORY_ROOT."/detailview.php"); ?>
	</div>