<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /rss/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(CLASSIFIED_EDIRECTORY_ROOT."/rss/mod_rewrite.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$levelObj = new ClassifiedLevel();
	$levelvalues = $levelObj->getLevelValues();

	$dbObj = db_getDBObJect();

	unset($searchReturn);
	$searchReturn = search_frontClassifiedSearch($_GET, "rss");
	$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]." AND"):(""))." Classified.level = ".db_formatString(max($levelvalues))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT 100";
	$result = $dbObj->query($sql);

	if (mysql_num_rows($result) <= 0) {
		unset($searchReturn);
		$searchReturn = search_frontClassifiedSearch($_GET, "rss");
		$sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." ".(($searchReturn["where_clause"])?("WHERE ".$searchReturn["where_clause"]):(""))." ".(($searchReturn["group_by"])?("GROUP BY ".$searchReturn["group_by"]):(""))." ".(($searchReturn["order_by"])?("ORDER BY ".$searchReturn["order_by"]):(""))." LIMIT 100";
		$result = $dbObj->query($sql);
	}

	while ($row = mysql_fetch_assoc($result)) {
		$classifieds[] = new Classified($row["id"]);
	}

	if ($classifieds) {

		$rssWriter = new RSSWriter();

		unset($channel_properties);
		if ($id) {
			$channel_properties["title"]			= EDIRECTORY_TITLE." ".ucwords(LANG_CLASSIFIED)." - ".$classifieds[0]->getString("title");
			$channel_properties["link"]				= DEFAULT_URL;
			$channel_properties["description"]		= EDIRECTORY_TITLE." ".ucwords(LANG_CLASSIFIED)." - ".$classifieds[0]->getString("title");
		} elseif (($category_id || $estado_id || $cidade_id || $bairro_id || $city_id || $area_id) && !$keyword && !$zip && !$dist) {
			if ($category_id) $rss_category = new ClassifiedCategory($category_id);
			if ($estado_id)  $rss_country  = new LocationCountry($estado_id);
			if ($cidade_id)    $rss_state    = new LocationState($cidade_id);
			if ($bairro_id)   $rss_region   = new LocationRegion($bairro_id);
			if ($city_id)     $rss_city     = new LocationCity($city_id);
			if ($area_id)     $rss_area     = new LocationArea($area_id);
			if ($estado_id || $cidade_id || $bairro_id || $city_id || $area_id) {
				if ($estado_id) $rsslocationstr[] = $rss_country->getString("name");
				if ($cidade_id)   $rsslocationstr[] = $rss_state->getString("name");
				if ($bairro_id)  $rsslocationstr[] = $rss_region->getString("name");
				if ($city_id)    $rsslocationstr[] = $rss_city->getString("name");
				if ($area_id)    $rsslocationstr[] = $rss_area->getString("name");
				$rss_location_str = implode(" / ", $rsslocationstr);
			}
			if ($category_id && !$estado_id && !$cidade_id && !$bairro_id && !$city_id && !$area_id) {
				$channel_properties["title"]		= EDIRECTORY_TITLE." - Guide ".$rss_category->getStringLang(EDIR_LANGUAGE, "title");
				$channel_properties["link"]			= DEFAULT_URL;
				$channel_properties["description"]	= EDIRECTORY_TITLE." - Guide ".$rss_category->getStringLang(EDIR_LANGUAGE, "title");
			} elseif (($estado_id || $cidade_id || $bairro_id || $city_id || $area_id) && !$category_id) {
				$channel_properties["title"]		= EDIRECTORY_TITLE." - Location ".$rss_location_str;
				$channel_properties["link"]			= DEFAULT_URL;
				$channel_properties["description"]	= EDIRECTORY_TITLE." - Location ".$rss_location_str;
			} else {
				$channel_properties["title"]		= EDIRECTORY_TITLE." - Guide ".$rss_category->getStringLang(EDIR_LANGUAGE, "title")." - Location ".$rss_location_str;
				$channel_properties["link"]			= DEFAULT_URL;
				$channel_properties["description"]	= EDIRECTORY_TITLE." - Guide ".$rss_category->getStringLang(EDIR_LANGUAGE, "title")." - Location ".$rss_location_str;
			}
		} else {
			$channel_properties["title"]			= EDIRECTORY_TITLE." - RSS Feed";
			$channel_properties["link"]				= DEFAULT_URL;
			$channel_properties["description"]		= EDIRECTORY_TITLE." - RSS Feed";
		}
		$rssWriter->addChannel($channel_properties);

		unset($image_properties);
		$image_properties["link"]		= DEFAULT_URL;
		if (file_exists(EDIRECTORY_ROOT.RSS_LOGO_PATH)) {
			$image_properties["url"]	= DEFAULT_URL.RSS_LOGO_PATH;
		} else {
			$image_properties["url"]	= DEFAULT_URL."/images/content/logo.png";
		}
		$image_properties["title"]		= EDIRECTORY_TITLE;
		$rssWriter->addChannelImage($image_properties);

		$level = new ClassifiedLevel();

		foreach ($classifieds as $each_classified) {

			unset($itens_properties);
			$itens_properties["title"]			= $each_classified->getString("title");
			if ($level->getDetail($each_classified->getNumber("level")) == "y") {
				if (MODREWRITE_FEATURE == "on") {
					$itens_properties["link"]	= CLASSIFIED_DEFAULT_URL."/".$each_classified->getString("friendly_url").".html";
				} else {
					$itens_properties["link"]	= CLASSIFIED_DEFAULT_URL."/detail.php?id=".$each_classified->getNumber("id");
				}
			} else {
				$itens_properties["link"]		= CLASSIFIED_DEFAULT_URL."/results.php?id=".$each_classified->getNumber("id");
			}
			$itens_properties["description"]	= $each_classified->getStringLang(EDIR_LANGUAGE, "summarydesc");
			$itens_properties["guid"]			= $itens_properties["link"];
			$itens_properties["phone"]			= $each_classified->getString("phone");
			$itens_properties["email"]			= $each_classified->getString("email");
			$itens_properties["url"]			= $each_classified->getString("url");
			$itens_properties["address"]		= $each_classified->getString("address");

			if ($each_classified->getNumber("thumb_id")) {
				$imageObj = new Image($each_classified->getNumber("thumb_id"));
				$itens_properties["img_src"]	= IMAGE_URL."/photo_".$imageObj->getNumber("id").".".strtolower($imageObj->getString("type"));
				$itens_properties["img_width"]	= $imageObj->getNumber("width");
				$itens_properties["img_height"]	= $imageObj->getNumber("height");
			}

			$rssWriter->addItem($itens_properties);

			$rssWriter->buildItem();

		}

		$rssWriter->buildChannel();

		$rssWriter->outputRSS();

	}

?>
