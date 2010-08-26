<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /content/index.php
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

	$contentObj = new Content();
	$content_id = $contentObj->retrieveIDByURL($content);
	if ($content_id) {
		$contentObj = new Content($content_id, EDIR_LANGUAGE);
		$content_show = $contentObj->retrieveContentByURL($content);
		$content_title = $contentObj->getString("title");
		$headertagtitle = $contentObj->getString("title");
		$headertagdescription = $contentObj->getString("description");
		$headertagkeywords = $contentObj->getString("keywords");
	} else {
		$content_show = "";
		$headertagtitle = "";
		$headertagdescription = "";
		$headertagkeywords = "";
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;
	$headertag_description = $headertagdescription;
	$headertag_keywords = $headertagkeywords;
	include(EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

?>

	<h1 class="standardTitle"><?=$content_title?></h1>
	<?
	if ($content_show) {
		echo "<div class=\"dynamicContent\">".$content_show."</div>";
	} else {
		echo "<p class=\"errorMessage\">".system_showText(LANG_MSG_NOTAVAILABLE)."</p>";
	}
	?>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/layout/footer.php");
?>
