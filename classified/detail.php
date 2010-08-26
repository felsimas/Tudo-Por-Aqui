<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classified/detail.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(CLASSIFIED_EDIRECTORY_ROOT."/mod_rewrite.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# CLASSIFIED
	# ----------------------------------------------------------------------------------------------------
	if (($_GET["id"]) || ($_POST["id"])) {
		$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
		$classified = new Classified($id);
		$level = new ClassifiedLevel(EDIR_DEFAULT_LANGUAGE, true);
		unset($classifiedMsg);
		if ((!$classified->getNumber("id")) || ($classified->getNumber("id") <= 0)) {
			$classifiedMsg = ucwords(CLASSIFIED_FEATURE_NAME)." not found!";
		} elseif ($classified->getString("status") != "A") {
			$classifiedMsg = ucwords(CLASSIFIED_FEATURE_NAME)." not available!";
		} elseif ($level->getDetail($classified->getNumber("level")) != "y") {
			$classifiedMsg = ucwords(CLASSIFIED_FEATURE_NAME)." not available!";
		} else {
			report_newRecord("classified", $id, CLASSIFIED_REPORT_DETAIL_VIEW);
		}
	} else {
		header("Location: ".CLASSIFIED_DEFAULT_URL."/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	if (($classified->getNumber("id")) && ($classified->getNumber("id") > 0)) {
		$claCategs = $classified->getCategories();
		if ($claCategs) {
			foreach ($claCategs as $claCateg) {
				$category_id[] = $claCateg->getNumber("id");
			}
		}
	}
	$_POST["category_id"] = $category_id;
	$extrastyle = DEFAULT_URL."/layout/detail.css";
	$banner_section = "classified";
	$headertag_title = (($classified->getString("seo_title"))?($classified->getString("seo_title")):($classified->getString("title")));
	$headertag_description = (($classified->getStringLang(EDIR_LANGUAGE, "seo_summarydesc"))?($classified->getStringLang(EDIR_LANGUAGE, "seo_summarydesc")):($classified->getStringLang(EDIR_LANGUAGE, "summarydesc")));
	$headertag_keywords = (($classified->getStringLang(EDIR_LANGUAGE, "seo_keywords"))?($classified->getStringLang(EDIR_LANGUAGE, "seo_keywords")):(str_replace(" || ", ", ", $classified->getStringLang(EDIR_LANGUAGE, "keywords"))));
	include(EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	if (EDIR_THEME) {
		include(THEMEFILE_DIR."/".EDIR_THEME."/body/classified_detail.php");
	} else {
		include(EDIRECTORY_ROOT."/frontend/body/classified_detail.php");
	}

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "classified";
	include(EDIRECTORY_ROOT."/layout/footer.php");

?>
