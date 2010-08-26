<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /article/detail.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# MOD-REWRITE
	# ----------------------------------------------------------------------------------------------------
	include(ARTICLE_EDIRECTORY_ROOT."/mod_rewrite.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# ARTICLE
	# ----------------------------------------------------------------------------------------------------
	if (($_GET["id"]) || ($_POST["id"])) {
		$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
		$article = new Article($id);
		$level = new ArticleLevel(EDIR_DEFAULT_LANGUAGE, true);
		unset($articleMsg);
		if ((!$article->getNumber("id")) || ($article->getNumber("id") <= 0)) {
			$articleMsg = ucwords(ARTICLE_FEATURE_NAME)." not found!";
		} elseif ($article->getString("status") != "A") {
			$articleMsg = ucwords(ARTICLE_FEATURE_NAME)." not available!";
		} elseif ($article->getString("publication_date") > date("Y-m-d")) {
			$articleMsg = ucwords(ARTICLE_FEATURE_NAME)." not available!";
		} elseif ($level->getDetail($article->getNumber("level")) != "y") {
			$articleMsg = ucwords(ARTICLE_FEATURE_NAME)." not available!";
		} else {
			report_newRecord("article", $id, ARTICLE_REPORT_DETAIL_VIEW);
		}
	} else {
		header("Location: ".ARTICLE_DEFAULT_URL."/");
		exit;
	}
	
	# ----------------------------------------------------------------------------------------------------
	# REVIEWS
	# ----------------------------------------------------------------------------------------------------
	if ($id)  $sql_where[] = " item_type = 'article' AND item_id = ".db_formatNumber($id)." ";
	if (true) $sql_where[] = " review IS NOT NULL AND review != '' ";
	if (true) $sql_where[] = " approved = '1' ";
	if ($sql_where) $sqlwhere .= " ".implode(" AND ", $sql_where)." ";
	$pageObj  = new pageBrowsing("Review", $screen, 3, "added DESC", "", "", $sqlwhere);
	$reviewsArr = $pageObj->retrievePage("object");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	if (($article->getNumber("id")) && ($article->getNumber("id") > 0)) {
		$artCategs = $article->getCategories();
		if ($artCategs) {
			foreach ($artCategs as $artCateg) {
				$category_id[] = $artCateg->getNumber("id");
			}
		}
	}
	$_POST["category_id"] = $category_id;
	$extrastyle = DEFAULT_URL."/layout/detail.css";
	$banner_section = "article";
	$headertag_title = (($article->getString("seo_title"))?($article->getString("seo_title")):($article->getString("title")));
	$headertag_description = (($article->getStringLang(EDIR_LANGUAGE, "seo_abstract"))?($article->getStringLang(EDIR_LANGUAGE, "seo_abstract")):($article->getStringLang(EDIR_LANGUAGE, "abstract")));
	$headertag_keywords = (($article->getStringLang(EDIR_LANGUAGE, "seo_keywords"))?($article->getStringLang(EDIR_LANGUAGE, "seo_keywords")):(str_replace(" || ", ", ", $article->getStringLang(EDIR_LANGUAGE, "keywords"))));
	include(EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	if (EDIR_THEME) {
		include(THEMEFILE_DIR."/".EDIR_THEME."/body/article_detail.php");
	} else {
		include(EDIRECTORY_ROOT."/frontend/body/article_detail.php");
	}

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$banner_section = "article";
	include(EDIRECTORY_ROOT."/layout/footer.php");

?>
