<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /listing/reviewcomments.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(LISTING_EDIRECTORY_ROOT."/mod_rewrite.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	// checking if ratings are enabled - security feature
	setting_get("rating_enabled", $rating_enabled);
	if ($rating_enabled != "on") {
		print "Ratings are disabled";
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/rating.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------  
	// Page Browsing /////////////////////////////////////////
	if ($listing_id) $sql_where[] = " listing_id = $listing_id ";
	if (true)        $sql_where[] = " review IS NOT NULL AND review != '' ";
	if (true)        $sql_where[] = " approved = '1' ";
	if ($sql_where)  $where .= " ".implode(" AND ", $sql_where)." ";

	$pageObj  = new pageBrowsing("Rating", $screen, 5, "added DESC", "", "", $where);
	$ratingsArr = $pageObj->retrievePage("object");

	$paging_url = LISTING_DEFAULT_URL."/reviewcomments.php";

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, "Go to page: ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$extrastyle = array(DEFAULT_URL."/layout/listing_result.css", DEFAULT_URL."/layout/listing_color.css");
	$banner_section = "listing";
	$headertag_title = "Reviews of ".$listingObj->getString("title");
	$headertag_description = "Reviews of ".$listingObj->getString("title").", ".$listingObj->getString("description");
	$headertag_keywords = str_replace(" || ", ", ", $listingObj->getString("keywords"));
	include(EDIRECTORY_ROOT."/layout/header.php");

?>

	<blockquote class="leftContent">

		<? include(LISTING_EDIRECTORY_ROOT."/search.php"); ?>

		<ul class="standard-iconlink">
			<li class="favoritesview-icon">
				<a href="<?=DEFAULT_URL?>/favorites.php<?=$favorites_lnk?>">View Quick List</a>
			</li>
		</ul>

		<? //GOOGLE ADS
		include(INCLUDES_DIR."/code/google_ads.php");
		?>

	</blockquote>

	<blockquote class="middleContent">

		<p class="standardTitle">Reviews of <span><?=$listingObj->getString("title")?></span></p>

		<?
		$level = new ListingLevel();
		$listing = $listingObj;
		$user = true;
		include(INCLUDES_DIR . "/views/view_listing_summary.php");
		unset($user);
		unset($listing);

		if ($pageObj->getString("pages") > 1) echo "<br />";

		include(INCLUDES_DIR."/tables/table_paging.php");

		if ($ratingsArr) {
			foreach ($ratingsArr as $each_rate) {
				if ($each_rate->getString("review")) {
					$each_rate->extract();
					include(INCLUDES_DIR."/views/view_rating.php");
					echo $listing_reviewcomment;
				}
			}
		} else {
			echo "<div class=\"response-msg notice ui-corner-all\">No review comment found for this ".LISTING_FEATURE_NAME."!</div>";
		}
		?>

	</blockquote>

	<blockquote class="rightContent">

		<?
		$banner_section = "listing";
		//$banner = system_showBanner("FEATURED", $category_id, $banner_section, $amount = 2);
		if ($banner) {
			?><div class="rightBanner"><h4>Advertisers</h4><span><?=$banner?></span></div><?
		}
		?>
		<?
		$banner_section = "listing";
		//$banner = system_showBanner("SPONSORED_LINKS", $category_id, $banner_section, $amount = 2);
		if ($banner) {
			?><div class="bannerleftText"><?=$banner?><a href="<?=DEFAULT_URL?>/order_banner.php?type=50" class="sponsoredLinks-buy">Buy a link &raquo;</a></div><?
		}
		?>

	</blockquote>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER BG White
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "listing";
	include(EDIRECTORY_ROOT."/layout/footer.php");
?>
