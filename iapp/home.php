<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /iapp/home.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$section = "home";
	$backButton = false;
	$headerTitle = EDIRECTORY_TITLE;
	$homeButton = false;
	$contactButton = true;
	$searchButton = false;
	$searchButtonLink = "";
	include(EDIRECTORY_ROOT."/iapp/layout/header.php");

?>

	<a class="listingButton" href="<?=DEFAULT_URL;?>/iapp/listing/main.php">
		<span><?=ucwords(LISTING_FEATURE_NAME);?></span>
	</a>

	<? if (EVENT_FEATURE == "on") { ?>
	<a class="eventButton" href="<?=DEFAULT_URL;?>/iapp/event/main.php">
		<span><?=ucwords(EVENT_FEATURE_NAME);?></span>
	</a>
	<? } ?>

	<? if (CLASSIFIED_FEATURE == "on") { ?>
	<a class="classifiedButton" href="<?=DEFAULT_URL;?>/iapp/classified/main.php">
		<span><?=ucwords(CLASSIFIED_FEATURE_NAME);?></span>
	</a>
	<? } ?>

	<? if (ARTICLE_FEATURE == "on") { ?>
	<a class="articleButton" href="<?=DEFAULT_URL;?>/iapp/article/main.php">
		<span><?=ucwords(ARTICLE_FEATURE_NAME);?></span>
	</a>
	<? } ?>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/iapp/layout/footer.php");
?>
