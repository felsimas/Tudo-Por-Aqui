<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /signup_banner.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (BANNER_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$bannerLevelObj = new BannerLevel(EDIR_LANGUAGE);
	$levelValue = $bannerLevelObj->getValues();

	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Banner Advertisement";
	$content = $contentObj->retrieveContentByType($sitecontentSection);
	if ($content) {
		echo "<blockquote>";
			echo "<div class=\"dynamicContent\">".$content."</div>";
		echo "</blockquote>";
	}

	foreach ($levelValue as $value) {

		$contentThisLevel = "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"advertiseTable\"><tr><td>".$bannerLevelObj->getContent($value)."</td></tr></table>";

		$posLevelName = strpos($contentThisLevel, "[LEVELNAME]");
		$posLevelPrice = strpos($contentThisLevel, "[LEVELPRICE]");
		$posLevelButton = strpos($contentThisLevel, "[LEVELBUTTON]");

		if ($bannerLevelObj->getPrice($value) > 0) $contentThisLevelPriceStr = CURRENCY_SYMBOL.$bannerLevelObj->getPrice($value);
		else $contentThisLevelPriceStr = CURRENCY_SYMBOL.system_showText(LANG_FREE);
		$contentThisLevelPriceStr .= " ".system_showText(LANG_PER)." ";
		if (payment_getRenewalCycle("banner") > 1) {
			$contentThisLevelPriceStr .= payment_getRenewalCycle("banner")." ";
			$contentThisLevelPriceStr .= payment_getRenewalUnitName("banner")."s";
		}else {
			$contentThisLevelPriceStr .= payment_getRenewalUnitName("banner");
		}
		$contentThisLevelPriceStr .= "<br />".system_showText(LANG_OR)."<br />";
		if ($bannerLevelObj->getImpressionPrice($value) > 0) $contentThisLevelPriceStr .= CURRENCY_SYMBOL.$bannerLevelObj->getImpressionPrice($value);
		else $contentThisLevelPriceStr .= CURRENCY_SYMBOL.system_showText(LANG_FREE);
		$contentThisLevelPriceStr .= " ".system_showText(LANG_PER)." ".$bannerLevelObj->getImpressionBlock($value)." ".system_showText(LANG_IMPRESSIONS);

		$contentThisLevel = str_replace("[LEVELNAME]", $bannerLevelObj->showLevel($value), $contentThisLevel);
		$contentThisLevel = str_replace("[LEVELPRICE]", $contentThisLevelPriceStr, $contentThisLevel);
		$contentThisLevel = str_replace("[LEVELBUTTON]", "<p class=\"standardButton orderButton\"><a href=\"".((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on" && FORCE_ORDER_SSL == "on") ? SECURE_URL : NON_SECURE_URL)."/order_banner.php?type=".$value."\">".system_showText(LANG_ORDERNOW)."</a></p>", $contentThisLevel);

		if (($posLevelName === false) || ($posLevelPrice === false)) {

			$contentThisLevelAux = "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"advertiseTable\"><tr>";

			if ($posLevelName === false) $contentThisLevelAux .= "<th class=\"type\">".$bannerLevelObj->showLevel($value)."</th>";

			if ($posLevelPrice === false) $contentThisLevelAux .= "<td class=\"prize\">".$contentThisLevelPriceStr."</td>";

			$contentThisLevelAux .= "</tr></table>";

			$contentThisLevel = $contentThisLevelAux.$contentThisLevel;

		}

		if ($posLevelButton === false) {

			$contentThisLevelAux = "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"advertiseTable\"><tr><td><p class=\"standardButton orderButton\"><a href=\"".((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on" && FORCE_ORDER_SSL == "on") ? SECURE_URL : NON_SECURE_URL)."/order_banner.php?type=".$value."\">".system_showText(LANG_ORDERNOW)."</a></p></td></tr></table>";

			$contentThisLevel = $contentThisLevel.$contentThisLevelAux;

		}

		$contentObj = new Content("", EDIR_LANGUAGE);
		$contentObj->setString("content", $contentThisLevel);
		echo "<blockquote>";
			echo $contentObj->getString("content", false);
		echo "</blockquote>";
		unset($contentObj);

	}

?>
