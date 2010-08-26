<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /event/detail.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(EVENT_EDIRECTORY_ROOT."/mod_rewrite.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# EVENT
	# ----------------------------------------------------------------------------------------------------
	if (($_GET["id"]) || ($_POST["id"])) {
		$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
		$event = new Event($id);
		$level = new EventLevel(EDIR_DEFAULT_LANGUAGE, true);
		unset($eventMsg);
		if ((!$event->getNumber("id")) || ($event->getNumber("id") <= 0)) {
			$eventMsg = ucwords(EVENT_FEATURE_NAME)." not found!";
		} elseif ($event->getString("status") != "A") {
			$eventMsg = ucwords(EVENT_FEATURE_NAME)." not available!";
		} elseif ($level->getDetail($event->getNumber("level")) != "y") {
			$eventMsg = ucwords(EVENT_FEATURE_NAME)." not available!";
		} else {
			report_newRecord("event", $id, EVENT_REPORT_DETAIL_VIEW);
		}
	} else {
		header("Location: ".EVENT_DEFAULT_URL."/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	if (($event->getNumber("id")) && ($event->getNumber("id") > 0)) {
		$evCategs = $event->getCategories();
		if ($evCategs) {
			foreach ($evCategs as $evCateg) {
				$category_id[] = $evCateg->getNumber("id");
			}
		}
	}
	$_POST["category_id"] = $category_id;
	$extrastyle = DEFAULT_URL."/layout/detail.css";
	$banner_section = "event";
	$headertag_title = (($event->getString("seo_title"))?($event->getString("seo_title")):($event->getString("title")));
	$headertag_description = (($event->getStringLang(EDIR_LANGUAGE, "seo_description"))?($event->getStringLang(EDIR_LANGUAGE, "seo_description")):($event->getStringLang(EDIR_LANGUAGE, "description")));
	$headertag_keywords = (($event->getStringLang(EDIR_LANGUAGE, "seo_keywords"))?($event->getStringLang(EDIR_LANGUAGE, "seo_keywords")):(str_replace(" || ", ", ", $event->getStringLang(EDIR_LANGUAGE, "keywords"))));
	include(EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	if (EDIR_THEME) {
		include(THEMEFILE_DIR."/".EDIR_THEME."/body/event_detail.php");
	} else {
		include(EDIRECTORY_ROOT."/frontend/body/event_detail.php");
	}

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "event";
	include(EDIRECTORY_ROOT."/layout/footer.php");

?>
