<?



?>

	<div class="sidebar">
		<? include(EDIRECTORY_ROOT."/frontend/login.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/join.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/featured_event.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/event_calendar.php"); ?>
		<? include(LISTING_EDIRECTORY_ROOT."/categories.php"); ?>
	</div>

	<div class="mainContent">
		<? include(EDIRECTORY_ROOT."/frontend/breadcrumb.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/sitecontent_top.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/featured_listing.php"); ?>
		<div class="baseFeatured">
			<? include(EDIRECTORY_ROOT."/frontend/featured_promotion.php"); ?>
		</div>
		<div class="baseFeatured">
			<? include(EDIRECTORY_ROOT."/frontend/featured_classified.php"); ?>
		</div>
		<div class="featuredArticle">
			<? include(EDIRECTORY_ROOT."/frontend/featured_article.php"); ?>
		</div>
		<? include(EDIRECTORY_ROOT."/frontend/featured_listing_review.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/sitecontent_bottom.php"); ?>
		<div class="baseAdvertisement">
			<? include(EDIRECTORY_ROOT."/frontend/banner_featured.php"); ?>
			<? include(EDIRECTORY_ROOT."/frontend/banner_sponsoredlinks.php"); ?>
			<? include(EDIRECTORY_ROOT."/frontend/googleads.php"); ?>
		</div>
	</div>
