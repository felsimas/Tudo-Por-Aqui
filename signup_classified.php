<?

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /signup_classified.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$classifiedLevelObj = new ClassifiedLevel(EDIR_LANGUAGE);
	$levelValue = $classifiedLevelObj->getValues();

	$contentObj = new Content("", EDIR_LANGUAGE);
	$sitecontentSection = "Classified Advertisement";
	$content = $contentObj->retrieveContentByType($sitecontentSection);
	if ($content) {
		echo "<blockquote>";
			echo "<div class=\"dynamicContent\">".$content."</div>";
		echo "</blockquote>";
	}

	foreach ($levelValue as $value) {

		$contentThisLevel = "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"advertiseTable\"><tr><td>".$classifiedLevelObj->getContent($value)."</td></tr></table>";

		$posLevelName = strpos($contentThisLevel, "[LEVELNAME]");
		$posLevelPrice = strpos($contentThisLevel, "[LEVELPRICE]");
		$posLevelButton = strpos($contentThisLevel, "[LEVELBUTTON]");

		if ($classifiedLevelObj->getPrice($value) > 0) {
			$contentThisLevelPriceStr = CURRENCY_SYMBOL.$classifiedLevelObj->getPrice($value)." ".system_showText(LANG_PER)." ";
			if (payment_getRenewalCycle("classified") > 1) {
				$contentThisLevelPriceStr .= payment_getRenewalCycle("classified")." ";
				$contentThisLevelPriceStr .= payment_getRenewalUnitName("classified")."s";
			}else {
				$contentThisLevelPriceStr .= payment_getRenewalUnitName("classified");
			}
		} else {
			$contentThisLevelPriceStr = CURRENCY_SYMBOL.system_showText(LANG_FREE);
		}

		$contentThisLevel = str_replace("[LEVELNAME]", $classifiedLevelObj->showLevel($value), $contentThisLevel);
		$contentThisLevel = str_replace("[LEVELPRICE]", $contentThisLevelPriceStr, $contentThisLevel);
		$contentThisLevel = str_replace("[LEVELBUTTON]", "<p class=\"standardButton orderButton\"><a href=\"".((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on" && FORCE_ORDER_SSL == "on") ? SECURE_URL : NON_SECURE_URL)."/order_classified.php?level=".$value."\">".system_showText(LANG_ORDERNOW)."</a></p>", $contentThisLevel);

		if (($posLevelName === false) || ($posLevelPrice === false)) {

			$contentThisLevelAux = "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"advertiseTable\"><tr>";

			if ($posLevelName === false) $contentThisLevelAux .= "<th class=\"type\">".$classifiedLevelObj->showLevel($value)."</th>";

			if ($posLevelPrice === false) $contentThisLevelAux .= "<td class=\"prize\">".$contentThisLevelPriceStr."</td>";

			$contentThisLevelAux .= "</tr></table>";

			$contentThisLevel = $contentThisLevelAux.$contentThisLevel;

		}

		if ($posLevelButton === false) {

			$contentThisLevelAux = "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"advertiseTable\"><tr><td><p class=\"standardButton orderButton\"><a href=\"".((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on" && FORCE_ORDER_SSL == "on") ? SECURE_URL : NON_SECURE_URL)."/order_classified.php?level=".$value."\">".system_showText(LANG_ORDERNOW)."</a></p></td></tr></table>";

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
