<?php



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/headertag.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	unset($headertag_templateObj);
	unset($headertag_categoryObj);
	unset($headertag_countryObj);
	unset($headertag_stateObj);
	unset($headertag_regionObj);
	unset($headertag_cityObj);
	unset($headertag_areaObj);
	unset($extra_headertag_title);
	unset($extra_headertag_title_keyword);
	unset($extra_headertag_title_where);
	unset($extra_headertag_title_template);
	unset($extra_headertag_title_category);
	unset($extra_headertag_title_location);
	unset($extra_headertag_title_zip);
	unset($extra_headertag_title_screen);
	unset($extra_headertag_title_page);

	if (strpos($_SERVER["PHP_SELF"], "results.php") !== false) {

		$keyword = ($_GET["keyword"]) ? $_GET["keyword"] : $_POST["keyword"];
		if ($keyword) {
			$extra_headertag_title_keyword = strtoupper($keyword);
		}

		$where = ($_GET["where"]) ? $_GET["where"] : $_POST["where"];
		if ($where) {
			$extra_headertag_title_where = strtoupper($where);
		}

		$template_id = ($_GET["template_id"]) ? $_GET["template_id"] : $_POST["template_id"];
		if ($template_id) {
			$headertag_templateObj = new ListingTemplate($template_id);
			if ($headertag_templateObj && $headertag_templateObj->getString("title")) {
				$extra_headertag_title_template = $headertag_templateObj->getString("title");
			}
		}

		$category_id = ($_GET["category_id"]) ? $_GET["category_id"] : $_POST["category_id"];
		if ($category_id) {
			if (strpos($_SERVER["PHP_SELF"], "article") !== false) {
				$headertag_categoryObj = new ArticleCategory($category_id);
			} elseif (strpos($_SERVER["PHP_SELF"], "classified") !== false) {
				$headertag_categoryObj = new ClassifiedCategory($category_id);
			} elseif (strpos($_SERVER["PHP_SELF"], "event") !== false) {
				$headertag_categoryObj = new EventCategory($category_id);
			} elseif (strpos($_SERVER["PHP_SELF"], "listing") !== false) {
				$headertag_categoryObj = new ListingCategory($category_id);
			} elseif (strpos($_SERVER["PHP_SELF"], "promotion") !== false) {
				$headertag_categoryObj = new ListingCategory($category_id);
			}
			if ($headertag_categoryObj && $headertag_categoryObj->getStringLang(EDIR_LANGUAGE, "title")) {
				$extra_headertag_title_category = $headertag_categoryObj->getStringLang(EDIR_LANGUAGE, "title");
			}
		}

		$estado_id = ($_GET["estado_id"]) ? $_GET["estado_id"] : $_POST["estado_id"];
		$cidade_id = ($_GET["cidade_id"]) ? $_GET["cidade_id"] : $_POST["cidade_id"];
		$bairro_id = ($_GET["bairro_id"]) ? $_GET["bairro_id"] : $_POST["bairro_id"];
		$city_id = ($_GET["city_id"]) ? $_GET["city_id"] : $_POST["city_id"];
		$area_id = ($_GET["area_id"]) ? $_GET["area_id"] : $_POST["area_id"];
		if ($estado_id) {
			$headertag_countryObj = new LocationCountry($estado_id);
			$extra_headertag_title_location = $headertag_countryObj->getString("name");
			if ($cidade_id) {
				$headertag_stateObj = new LocationState($cidade_id);
				$extra_headertag_title_location = $headertag_stateObj->getString("name").", ".$extra_headertag_title_location;
				if ($bairro_id) {
					$headertag_regionObj = new LocationRegion($bairro_id);
					$extra_headertag_title_location = $headertag_regionObj->getString("name").", ".$extra_headertag_title_location;
					if ($city_id) {
						$headertag_cityObj = new LocationCity($city_id);
						$extra_headertag_title_location = $headertag_cityObj->getString("name").", ".$extra_headertag_title_location;
						if ($area_id) {
							$headertag_areaObj = new LocationArea($area_id);
							$extra_headertag_title_location = $headertag_areaObj->getString("name").", ".$extra_headertag_title_location;
						}
					}
				}
			}
		}

		$zip = ($_GET["zip"]) ? $_GET["zip"] : $_POST["zip"];
		if ($zip) {
			$extra_headertag_title_zip .= ZIPCODE_LABEL." ".$zip.(($dist)?(" (".$dist." ".ZIPCODE_UNIT_LABEL_PLURAL.")"):(""));
		}

		$screen = ($_GET["screen"]) ? $_GET["screen"] : $_POST["screen"];
		if ($screen) {
			$extra_headertag_title_screen = $screen;
		}

		$page = ($_GET["page"]) ? $_GET["page"] : $_POST["page"];
		if ($page) {
			$extra_headertag_title_page = $page;
		}

		$extra_headertag_title = "";
		if ($extra_headertag_title_keyword) {
			$extra_headertag_title .= " ".system_showText(LANG_SEARCHRESULTS_KEYWORD)." ".$extra_headertag_title_keyword;
		}
		if ($extra_headertag_title_where) {
			$extra_headertag_title .= " ".system_showText(LANG_SEARCHRESULTS_WHERE)." ".$extra_headertag_title_where;
		}
		if ($extra_headertag_title_template) {
			$extra_headertag_title .= " ".system_showText(LANG_SEARCHRESULTS_TEMPLATE)." ".$extra_headertag_title_template;
		}
		if ($extra_headertag_title_category) {
			$extra_headertag_title .= " ".system_showText(LANG_SEARCHRESULTS_CATEGORY)." ".$extra_headertag_title_category;
		}
		if ($extra_headertag_title_location) {
			$extra_headertag_title .= " ".system_showText(LANG_SEARCHRESULTS_LOCATION)." ".$extra_headertag_title_location;
		}
		if ($extra_headertag_title_zip) {
			$extra_headertag_title .= " ".system_showText(LANG_SEARCHRESULTS_ZIP)." ".$extra_headertag_title_zip;
		}
		if ($extra_headertag_title_screen) {
			$extra_headertag_title .= " - ".system_showText(LANG_SEARCHRESULTS_PAGE)." ".$extra_headertag_title_screen;
		}
		if ($extra_headertag_title_page) {
			$extra_headertag_title .= " - ".system_showText(LANG_SEARCHRESULTS_PAGE)." ".$extra_headertag_title_page;
		}
		if ($extra_headertag_title) {
			$extra_headertag_title = system_showText(LANG_SEARCHRESULTS)." ".$extra_headertag_title." | ";
		} else {
			$extra_headertag_title = system_showText(LANG_SEARCHRESULTS)." | ";
		}

	}

	if (!$headertag_title) {
		customtext_get("header_title", $header_title, EDIR_LANGUAGE);
		$headertag_title = (($header_title) ? ($header_title) : (EDIRECTORY_TITLE));
	}

	if ($extra_headertag_title) {
		$headertag_title = $extra_headertag_title.$headertag_title ;
	}

	if (!$headertag_author) {
		customtext_get("header_author", $header_author, EDIR_LANGUAGE);
		$headertag_author = (($header_author) ? ($header_author) : ("Sis Dir 2009 - Classificados"));
	}

	if (!$headertag_description) {
		customtext_get("header_description", $header_description, EDIR_LANGUAGE);
		$headertag_description = (($header_description) ? ($header_description) : (EDIRECTORY_TITLE));
	}

	if (!$headertag_keywords) {
		customtext_get("header_keywords", $header_keywords, EDIR_LANGUAGE);
		$headertag_keywords = (($header_keywords) ? ($header_keywords) : EDIRECTORY_TITLE);
	}

	unset($headertag_templateObj);
	unset($headertag_categoryObj);
	unset($headertag_countryObj);
	unset($headertag_stateObj);
	unset($headertag_regionObj);
	unset($headertag_cityObj);
	unset($headertag_areaObj);
	unset($extra_headertag_title);
	unset($extra_headertag_title_keyword);
	unset($extra_headertag_title_where);
	unset($extra_headertag_title_template);
	unset($extra_headertag_title_category);
	unset($extra_headertag_title_location);
	unset($extra_headertag_title_zip);
	unset($extra_headertag_title_screen);
	unset($extra_headertag_title_page);

?>
