<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /mobile/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (MOBILE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if (strpos($_SERVER["PHP_SELF"], "/listing") !== false) {
		$formAction = "listingresults.php";
	} elseif (strpos($_SERVER["PHP_SELF"], "/event") !== false) {
		$formAction = "eventresults.php";
	} elseif (strpos($_SERVER["PHP_SELF"], "/classified") !== false) {
		$formAction = "classifiedresults.php";
	} elseif (strpos($_SERVER["PHP_SELF"], "/article") !== false) {
		$formAction = "articleresults.php";
	} else {
		$formAction = "results.php";
	}

?>

	<form method="get" action="<?=MOBILE_DEFAULT_URL?>/<?=$formAction?>">
		<div class="search">
			<? if ($_GET["lang"]) { ?>
				<input type="hidden" name="lang" value="<?=$_GET["lang"]?>" />
			<? } ?>
			<p><?=system_showText(LANG_LABEL_SEARCHKEYWORD);?></p>
			<input type="text" name="keyword" value="<?=$keyword?>" />
			<input type="submit" value="<?=system_showText(LANG_BUTTON_SEARCH);?>" class="searchButton" />
		</div>
	</form>
