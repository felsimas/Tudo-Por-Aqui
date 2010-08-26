<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /article/mod_rewrite.php
	# ----------------------------------------------------------------------------------------------------

	$failure = false;
	$dbObj = db_getDBObject();

	$langIndex = language_getIndex(EDIR_LANGUAGE);

	$browsebycategory = false;
	$browsebyitem = false;

	##################################################
	# CATEGORY
	##################################################
	if ($_GET["category1"]) {
		$browsebycategory = true;
		$sql = "SELECT * FROM ArticleCategory WHERE category_id = ".db_formatNumber("0")." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND friendly_url".$langIndex." = ".db_formatString($_GET["category1"])." LIMIT 1";
		$result = $dbObj->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["category_id"] = $aux["id"];
		if (!$_GET["category_id"]) $failure = true;
	}

	if ($_GET["category2"] && $_GET["category_id"] && !$failure) {
		$browsebycategory = true;
		$sql = "SELECT * FROM ArticleCategory WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND friendly_url".$langIndex." = ".db_formatString($_GET["category2"])." LIMIT 1";
		$result = $dbObj->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["category_id"] = $aux["id"];
		if (!$_GET["category_id"]) $failure = true;
	} elseif ($_GET["category2"]) {
		$failure = true;
	}
	##################################################

	##################################################
	# ARTICLE
	##################################################
	if ($_GET["article"]) {
		$browsebyitem = true;
		$sql = "SELECT Article.id as id FROM Article WHERE Article.friendly_url = ".db_formatString($_GET["article"])." LIMIT 1";
		$result = $dbObj->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["id"] = $aux["id"];
		if (!$_GET["id"]) $failure = true;
	}
	##################################################

	##################################################
	# UNSETTING MODREWRITE TERMS
	##################################################
	if ($failure) {
		header("Location: ".ARTICLE_DEFAULT_URL."/index.php");
		exit;
	} else {
		unset($failure);
		unset($dbObj);
		unset($sql);
		unset($result);
		unset($aux);
		unset($_GET["category1"]);
		unset($_GET["category2"]);
		unset($_GET["article"]);
	}
	##################################################

?>
