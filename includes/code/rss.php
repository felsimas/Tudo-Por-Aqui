<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/rss.php
	# ----------------------------------------------------------------------------------------------------

	if (!function_exists("getRSSTreeCategory")) {
		function getRSSTreeCategory($categoryID, $itemRSSSection) {
			unset($strRet);
			$dbObj = db_getDBObject();
			if ($itemRSSSection == "listing") $categoryObj = new ListingCategory($categoryID);
			elseif ($itemRSSSection == "event") $categoryObj = new EventCategory($categoryID);
			elseif ($itemRSSSection == "classified") $categoryObj = new ClassifiedCategory($categoryID);
			elseif ($itemRSSSection == "article") $categoryObj = new ArticleCategory($categoryID);
			$sql = "SELECT id FROM ".ucwords($itemRSSSection)."Category WHERE id = ".$categoryObj->getNumber("category_id")."";
			$result = $dbObj->query($sql);
			if (mysql_num_rows($result) > 0) {
				while ($row = mysql_fetch_assoc($result)) {
					$strRet = getRSSTreeCategory($row["id"], $itemRSSSection);
				}
			}
			$strRet[] = $categoryObj->getStringLang(EDIR_LANGUAGE, "friendly_url");
			return $strRet;
		}
	}

	unset($rss_querystring, $rss_friendlyurl);

	if ($_GET["category_id"]) {
		$rss_querystring[] = "category_id=".$_GET["category_id"];
		$rss_treecategory = getRSSTreeCategory($_GET["category_id"], $itemRSSSection);
		$rss_friendlyurl["category_id"] = "guide_".implode("_", $rss_treecategory);
		unset($rss_treecategory);
	}

	if ($_GET["estado_id"]) {
		$rss_querystring[] = "estado_id=".$_GET["estado_id"];
		$rss_country = new LocationCountry($_GET["estado_id"]);
		$rss_location["estado_id"] = $rss_country->getString("friendly_url");
		unset($rss_country);
		$rss_friendlyurl["location"] = "location_".implode("_", $rss_location);
		unset($rss_location);
	}

	if ($_GET["cidade_id"]) {
		$rss_querystring[] = "cidade_id=".$_GET["cidade_id"];
		$rss_state = new LocationState($_GET["cidade_id"]);
		if (!$rss_location["estado_id"]) {
			$rss_country = new LocationCountry($rss_state->getNumber("estado_id"));
			$rss_location["estado_id"] = $rss_country->getString("friendly_url");
			unset($rss_country);
		}
		$rss_location["cidade_id"] = $rss_state->getString("friendly_url");
		unset($rss_state);
		$rss_friendlyurl["location"] = "location_".implode("_", $rss_location);
		unset($rss_location);
	}

	if ($_GET["bairro_id"]) {
		$rss_querystring[] = "bairro_id=".$_GET["bairro_id"];
		$rss_region = new LocationRegion($_GET["bairro_id"]);
		if (!$rss_location["cidade_id"]) {
			$rss_state = new LocationState($rss_region->getNumber("cidade_id"));
			if (!$rss_location["estado_id"]) {
				$rss_country = new LocationCountry($rss_state->getNumber("estado_id"));
				$rss_location["estado_id"] = $rss_country->getString("friendly_url");
				unset($rss_country);
			}
			$rss_location["cidade_id"] = $rss_state->getString("friendly_url");
			unset($rss_state);
		}
		$rss_location["bairro_id"] = $rss_region->getString("friendly_url");
		unset($rss_region);
		$rss_friendlyurl["location"] = "location_".implode("_", $rss_location);
		unset($rss_location);
	}

	if ($_GET["city_id"]) {
		$rss_querystring[] = "city_id=".$_GET["city_id"];
		$rss_city = new LocationCity($_GET["city_id"]);
		if (!$rss_location["bairro_id"]) {
			$rss_region = new LocationRegion($rss_city->getNumber("bairro_id"));
			if (!$rss_location["cidade_id"]) {
				$rss_state = new LocationState($rss_region->getNumber("cidade_id"));
				if (!$rss_location["estado_id"]) {
					$rss_country = new LocationCountry($rss_state->getNumber("estado_id"));
					$rss_location["estado_id"] = $rss_country->getString("friendly_url");
					unset($rss_country);
				}
				$rss_location["cidade_id"] = $rss_state->getString("friendly_url");
				unset($rss_state);
			}
			$rss_location["bairro_id"] = $rss_region->getString("friendly_url");
			unset($rss_region);
		}
		$rss_location["city_id"] = $rss_city->getString("friendly_url");
		unset($rss_city);
		$rss_friendlyurl["location"] = "location_".implode("_", $rss_location);
		unset($rss_location);
	}

	if ($_GET["area_id"]) {
		$rss_querystring[] = "area_id=".$_GET["area_id"];
		$rss_area = new LocationArea($_GET["area_id"]);
		if (!$rss_location["city_id"]) {
			$rss_city = new LocationCity($rss_area->getNumber("city_id"));
			if (!$rss_location["bairro_id"]) {
				$rss_region = new LocationRegion($rss_city->getNumber("bairro_id"));
				if (!$rss_location["cidade_id"]) {
					$rss_state = new LocationState($rss_region->getNumber("cidade_id"));
					if (!$rss_location["estado_id"]) {
						$rss_country = new LocationCountry($rss_state->getNumber("estado_id"));
						$rss_location["estado_id"] = $rss_country->getString("friendly_url");
						unset($rss_country);
					}
					$rss_location["cidade_id"] = $rss_state->getString("friendly_url");
					unset($rss_state);
				}
				$rss_location["bairro_id"] = $rss_region->getString("friendly_url");
				unset($rss_region);
			}
			$rss_location["city_id"] = $rss_city->getString("friendly_url");
			unset($rss_city);
		}
		$rss_location["area_id"] = $rss_area->getString("friendly_url");
		unset($rss_area);
		$rss_friendlyurl["location"] = "location_".implode("_", $rss_location);
		unset($rss_location);
	}

	if ($_GET["keyword"]) {
		$rss_querystring[] = "keyword=".$_GET["keyword"];
		$rss_friendlyurl["keyword"] = "";
	}

	if ($_GET["zip"]) {
		$rss_querystring[] = "zip=".$_GET["zip"];
		$rss_friendlyurl["zip"] = "";
	}

	if ($_GET["dist"]) {
		$rss_querystring[] = "dist=".$_GET["dist"];
		$rss_friendlyurl["dist"] = "";
	}

	if ($_GET["id"]) {
		$rss_querystring[] = "id=".$_GET["id"];
		if ($itemRSSSection == "listing") ${"rss_".$itemRSSSection} = new Listing($_GET["id"]);
		elseif ($itemRSSSection == "event") ${"rss_".$itemRSSSection} = new Event($_GET["id"]);
		elseif ($itemRSSSection == "classified") ${"rss_".$itemRSSSection} = new Classified($_GET["id"]);
		elseif ($itemRSSSection == "article") ${"rss_".$itemRSSSection} = new Article($_GET["id"]);
		$rss_friendlyurl["id"] = ${"rss_".$itemRSSSection}->getString("friendly_url");
		unset(${"rss_".$itemRSSSection});
	}

	if ($rss_querystring) {
		$rssLink = "".constant(strtoupper($itemRSSSection."_DEFAULT_URL"))."/rss/index.php?".implode("&", $rss_querystring);
	} else {
		$rssLink = "".constant(strtoupper($itemRSSSection."_DEFAULT_URL"))."/rss/index.php";
	}

	if (MODREWRITE_FEATURE == "on") {
		if ($rss_friendlyurl) {
			if (!array_key_exists("keyword", $rss_friendlyurl) && !array_key_exists("zip", $rss_friendlyurl) && !array_key_exists("dist", $rss_friendlyurl)) {
				if (array_key_exists("id", $rss_friendlyurl) && (count($rss_friendlyurl) == 1)) {
					$rssLink = "".constant(strtoupper($itemRSSSection."_DEFAULT_URL"))."/rss/".$itemRSSSection."_".$rss_friendlyurl["id"].".xml";
				} elseif (!array_key_exists("id", $rss_friendlyurl)) {
					$rssLink = "".constant(strtoupper($itemRSSSection."_DEFAULT_URL"))."/rss/".$itemRSSSection."_".implode("_", $rss_friendlyurl).".xml";
				}
			}
		} else {
			$rssLink = "".constant(strtoupper($itemRSSSection."_DEFAULT_URL"))."/rss/".$itemRSSSection.".xml";
		}
	}

	echo "<a class=\"rssResults\" href=\"".$rssLink."\" target=\"_blank\" title=\"".system_showText(LANG_LABEL_SUBSCRIBERSS)."\"><img src=\"".DEFAULT_URL."/images/content/icon_rss.gif\" alt=".system_showText(LANG_LABEL_SUBSCRIBERSS)."\"></a>";

	unset($rss_querystring, $rss_friendlyurl, $rssLink);

?>
