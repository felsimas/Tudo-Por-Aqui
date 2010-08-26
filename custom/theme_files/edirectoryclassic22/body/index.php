<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /body/index.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="sidebar">
		<? include(EDIRECTORY_ROOT."/frontend/join.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/login.php"); ?>
		<div class="baseSponsoredLinks"><? include(EDIRECTORY_ROOT."/frontend/banner_sponsoredlinks.php"); ?></div>
		<? include(EDIRECTORY_ROOT."/frontend/googleads.php"); ?>
	</div>

	<div class="mainContent">
		<? include(EDIRECTORY_ROOT."/frontend/breadcrumb.php"); ?>
		<? include(EDIRECTORY_ROOT."/frontend/sitecontent_top.php"); ?>
		<div class="frontFeaturedListings">
			<? include(EDIRECTORY_ROOT."/frontend/featured_listing.php"); ?>
		</div>
		<div class="frontFeaturedPromotions">
			<? include(EDIRECTORY_ROOT."/frontend/featured_promotion.php"); ?>
		</div>
		<div class="frontFeaturedClassifieds">
			<? include(EDIRECTORY_ROOT."/frontend/featured_classified.php"); ?>
		</div>
		<div class="frontFeaturedArticles">
			<? include(EDIRECTORY_ROOT."/frontend/featured_article.php"); ?>
		</div>
		<div class="frontFeaturedListings recentReviews">
			<? include(EDIRECTORY_ROOT."/frontend/featured_listing_review.php"); ?>
		</div>
		<? include(EDIRECTORY_ROOT."/frontend/sitecontent_bottom.php"); ?>
	</div>

	<div class="sidebar">
		<div class="frontFeaturedEvents">
			<? include(EDIRECTORY_ROOT."/frontend/featured_event.php"); ?>
		</div>
		<div class="baseBannerFeatured"><? include(EDIRECTORY_ROOT."/frontend/banner_featured.php"); ?></div>
	</div>
