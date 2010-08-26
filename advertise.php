<?php

	include("./conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Advertise with Us";
	$sitecontentinfo = $contentObj->retrieveContentInfoByType($sitecontentSection);
	if ($sitecontentinfo) {
		$headertagtitle = $sitecontentinfo["title"];
		$headertagdescription = $sitecontentinfo["description"];
		$headertagkeywords = $sitecontentinfo["keywords"];
		$sitecontent = $sitecontentinfo["content"];
	} else {
		$headertagtitle = "";
		$headertagdescription = "";
		$headertagkeywords = "";
		$sitecontent = "";
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$extrastyle = DEFAULT_URL."/layout/general_advertise.css";
	$headertag_title = $headertagtitle;
	$headertag_description = $headertagdescription;
	$headertag_keywords = $headertagkeywords;
	include(EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

?>

<script language="javascript" type="text/javascript">
	<!--

	function signupType(type) {

		if (document.getElementById("signupMenuListing")) document.getElementById("signupMenuListing").className = "advertiseMenuInactive";
		if (document.getElementById("signupMenuEvent")) document.getElementById("signupMenuEvent").className = "advertiseMenuInactive";
		if (document.getElementById("signupMenuBanner")) document.getElementById("signupMenuBanner").className = "advertiseMenuInactive";
		if (document.getElementById("signupMenuClassified")) document.getElementById("signupMenuClassified").className = "advertiseMenuInactive";
		if (document.getElementById("signupMenuArticle")) document.getElementById("signupMenuArticle").className = "advertiseMenuInactive";

		if (document.getElementById("signupAdvertisementListing")) document.getElementById("signupAdvertisementListing").className = "isHidden";
		if (document.getElementById("signupAdvertisementEvent")) document.getElementById("signupAdvertisementEvent").className = "isHidden";
		if (document.getElementById("signupAdvertisementBanner")) document.getElementById("signupAdvertisementBanner").className = "isHidden";
		if (document.getElementById("signupAdvertisementClassified")) document.getElementById("signupAdvertisementClassified").className = "isHidden";
		if (document.getElementById("signupAdvertisementArticle")) document.getElementById("signupAdvertisementArticle").className = "isHidden";

		if (type == "listing") {
			if (document.getElementById("signupMenuListing")) document.getElementById("signupMenuListing").className = "advertiseMenuActive";
			if (document.getElementById("signupAdvertisementListing")) document.getElementById("signupAdvertisementListing").className = "isVisible";
		} else if (type == "event") {
			if (document.getElementById("signupMenuEvent")) document.getElementById("signupMenuEvent").className = "advertiseMenuActive";
			if (document.getElementById("signupAdvertisementEvent")) document.getElementById("signupAdvertisementEvent").className = "isVisible";
		} else if (type == "banner") {
			if (document.getElementById("signupMenuBanner")) document.getElementById("signupMenuBanner").className = "advertiseMenuActive";
			if (document.getElementById("signupAdvertisementBanner")) document.getElementById("signupAdvertisementBanner").className = "isVisible";
		} else if (type == "classified") {
			if (document.getElementById("signupMenuClassified")) document.getElementById("signupMenuClassified").className = "advertiseMenuActive";
			if (document.getElementById("signupAdvertisementClassified")) document.getElementById("signupAdvertisementClassified").className = "isVisible";
		} else if (type == "article") {
			if (document.getElementById("signupMenuArticle")) document.getElementById("signupMenuArticle").className = "advertiseMenuActive";
			if (document.getElementById("signupAdvertisementArticle")) document.getElementById("signupAdvertisementArticle").className = "isVisible";
		}

	}

	//-->
</script>

<div>

	<?
	if ($sitecontent) {
		echo "<div class=\"dynamicContent\">".$sitecontent."</div>";
	}
	?>

	<ul class="advertiseTabs">

			<li id="signupMenuListing" class="advertiseMenuInactive"><a href="javascript:void(0);" onclick="signupType('listing');"><?=system_showText(LANG_LISTING_OPTIONS)?></a></li>
	
			<? if (EVENT_FEATURE == "on") { ?>
				<li id="signupMenuEvent" class="advertiseMenuInactive"><a href="javascript:void(0);" onclick="signupType('event');"><?=system_showText(LANG_EVENT_OPTIONS)?></a></li>
			<? } ?>
	

			
			<? if (BANNER_FEATURE == "on") { ?>
				<li id="signupMenuBanner" class="advertiseMenuInactive"><a href="javascript:void(0);" onclick="signupType('banner');"><?=system_showText(LANG_BANNER_OPTIONS)?></a></li>
			<? } ?>
	</ul>
	
	<div class="advertiseContent">

		<div id="signupAdvertisementListing" class="isHidden">
			<? include(EDIRECTORY_ROOT."/signup_listing.php"); ?>
		</div>
	
		<? if (EVENT_FEATURE == "on") { ?>
			<div id="signupAdvertisementEvent" class="isHidden">
				<? include(EDIRECTORY_ROOT."/signup_event.php"); ?>
			</div>
		<? } ?>
	
		<? if (CLASSIFIED_FEATURE == "on") { ?>
			<div id="signupAdvertisementClassified" class="isHidden">
				<? include(EDIRECTORY_ROOT."/signup_classified.php"); ?>
			</div>
		<? } ?>
	
		<? if (ARTICLE_FEATURE == "on") { ?>
			<div id="signupAdvertisementArticle" class="isHidden">
				<? include(EDIRECTORY_ROOT."/signup_article.php"); ?>
			</div>
		<? } ?>
	
		<? if (BANNER_FEATURE == "on") { ?>
			<div id="signupAdvertisementBanner" class="isHidden">
				<? include(EDIRECTORY_ROOT."/signup_banner.php"); ?>
			</div>
		<? } ?>
	
	</div>

	<?
	$contentObj = new Content("", EDIR_LANGUAGE);
	$content = $contentObj->retrieveContentByType("Advertise with Us Bottom");
	if ($content) {
		echo "<blockquote>";
			echo "<div class=\"dynamicContent\">".$content."</div>";
		echo "</blockquote>";
	}
	?>

</div>

<script language="javascript" type="text/javascript">
	<?
	if (isset($_GET["event"])) echo "signupType('event');";
	elseif (isset($_GET["banner"])) echo "signupType('banner');";
	elseif (isset($_GET["classified"])) echo "signupType('classified');";
	elseif (isset($_GET["article"])) echo "signupType('article');";
	elseif (isset($_GET["listing"])) echo "signupType('listing');";
	else echo "signupType('listing');";
	?>
</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/layout/footer.php");
?>
