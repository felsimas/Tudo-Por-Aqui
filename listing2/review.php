<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /listing/review.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

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

	$rating = $_POST["rating"];

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$_POST["reviewer_name"] = system_denyInjections($_POST["reviewer_name"]);
		$_POST["reviewer_email"] = system_denyInjections($_POST["reviewer_email"]);
		$_POST["reviewer_location"] = system_denyInjections($_POST["reviewer_location"]);
		$_POST["review_title"] = system_denyInjections($_POST["review_title"]);
		$_POST["review"] = system_denyInjections($_POST["review"]);
	}
	include(INCLUDES_DIR."/code/rating.php");

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

	<script type="text/javascript" language="javascript">

		function setDisplayRatingLevel(level) {
			for(i = 1; i <= 5; i++) {
				var starImg = "img_rateStarOff.gif";
				if( i <= level ) {
					starImg = "img_rateStarOn.gif";
				}
				var imgName = 'star'+i;
				document.images[imgName].src="<?=DEFAULT_URL?>/images/design/"+starImg;
			}
		}

		function resetRatingLevel() {
			setDisplayRatingLevel(document.rate_form.rating.value);
		}

		function setRatingLevel(level) {
			document.rate_form.rating.value = level;
		}

	</script>

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

		<? if ($success_rating) { ?>
			<div class="response-msg success ui-corner-all"><?=$message_rating?></div>
		<? } ?>

		<?
		$level = new ListingLevel();
		$listing = $listingObj;
		$user = true;
		$bt_rate_off = true;
		include(INCLUDES_DIR."/views/view_listing_summary.php");
		unset($user);
		unset($listing);
		?>

		<? if (!$success_rating) { ?>
			<form name="rate_form" action="<?=$_SERVER["PHP_SELF"]?>" method="post">
				<input type="hidden" name="listing_id" value="<?=$listing_id?>" />
				<? include(INCLUDES_DIR."/forms/form_rating.php"); ?>
				<ul class="standardButton" style="padding-left: 230px;">
					<li><button type="submit" name="submit" value="Submit">Submit</button></li>
				</ul>
			</form>
		<? } ?>

	</blockquote>

	<blockquote class="rightContent">

		<?
		$banner_section = "listing";
		//$banner = system_showBanner("FEATURED", $category_id, $banner_section, $amount = 2);
		if ($banner) {
			?><div class="rightBanner"><h4>Advertisers</h4><span class="alignCenter"><?=$banner?></span></div><?
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
