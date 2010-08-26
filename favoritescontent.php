<?
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
?>

	<h2 class="standardTitle"><?=system_showText(system_highlightLastWord(LANG_LABEL_QUICKLIST));?></h2>

	<? $myfavorites = 0; ?>

	<? include(LISTING_EDIRECTORY_ROOT."/quicklist.php"); ?>
	<? include(PROMOTION_EDIRECTORY_ROOT."/quicklist.php"); ?>
	<? if (EVENT_FEATURE == "on") include(EVENT_EDIRECTORY_ROOT."/quicklist.php"); ?>
	<? if (CLASSIFIED_FEATURE == "on") include(CLASSIFIED_EDIRECTORY_ROOT."/quicklist.php"); ?>
	<? if (ARTICLE_FEATURE == "on") include(ARTICLE_EDIRECTORY_ROOT."/quicklist.php"); ?>

	<?
	if (!$myfavorites) {
		echo "<div class=\"response-msg notice ui-corner-all\">".system_showText(LANG_LABEL_NOQUICKLIST)."</div>";
	}
	?>
