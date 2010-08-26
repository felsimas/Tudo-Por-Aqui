<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /listing/mod_rewrite.php
	# ----------------------------------------------------------------------------------------------------

	$failure = false;
	$dbObj = db_getDBObject();

	$langIndex = language_getIndex(EDIR_LANGUAGE);

	$browsebylocation = false;
	$browsebycategory = false;
	$browsebyitem = false;

	##################################################
	# LOCATION
	##################################################
	if ($_GET["country"]) {
		$browsebylocation = true;
		$sql = "SELECT id FROM Location_Country WHERE friendly_url = ".db_formatString($_GET["country"])." LIMIT 1";
		$result = $dbObj->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["estado_id"] = $aux["id"];
		if (!$_GET["estado_id"]) $failure = true;
	}

	if ($_GET["state"] && $_GET["estado_id"] && !$failure) {
		$browsebylocation = true;
		$sql = "SELECT id FROM Location_State WHERE estado_id = ".db_formatNumber($_GET["estado_id"])." AND friendly_url = ".db_formatString($_GET["state"])." LIMIT 1";
		$result = $dbObj->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["cidade_id"] = $aux["id"];
		if (!$_GET["cidade_id"]) $failure = true;
	} elseif ($_GET["state"]) {
		$failure = true;
	}

	if ($_GET["region"] && $_GET["cidade_id"] && !$failure) {
		$browsebylocation = true;
		$sql = "SELECT id FROM Location_Region WHERE cidade_id = ".db_formatNumber($_GET["cidade_id"])." AND friendly_url = ".db_formatString($_GET["region"])." LIMIT 1";
		$result = $dbObj->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["bairro_id"] = $aux["id"];
		if (!$_GET["bairro_id"]) $failure = true;
	} elseif ($_GET["region"]) {
		$failure = true;
	}
	##################################################

	##################################################
	# CATEGORY
	##################################################
	if ($_GET["category1"]) {
		$browsebycategory = true;
		$sql = "SELECT * FROM ListingCategory WHERE category_id = ".db_formatNumber("0")." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND friendly_url".$langIndex." = ".db_formatString($_GET["category1"])." LIMIT 1";
		$result = $dbObj->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["category_id"] = $aux["id"];
		if (!$_GET["category_id"]) $failure = true;
	}

	if ($_GET["category2"] && $_GET["category_id"] && !$failure) {
		$browsebycategory = true;
		$sql = "SELECT * FROM ListingCategory WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND friendly_url".$langIndex." = ".db_formatString($_GET["category2"])." LIMIT 1";
		$result = $dbObj->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["category_id"] = $aux["id"];
		if (!$_GET["category_id"]) $failure = true;
	} elseif ($_GET["category2"]) {
		$failure = true;
	}

	if ($_GET["category3"] && $_GET["category_id"] && !$failure) {
		$browsebycategory = true;
		$sql = "SELECT * FROM ListingCategory WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND friendly_url".$langIndex." = ".db_formatString($_GET["category3"])." LIMIT 1";
		$result = $dbObj->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["category_id"] = $aux["id"];
		if (!$_GET["category_id"]) $failure = true;
	} elseif ($_GET["category3"]) {
		$failure = true;
	}

	if ($_GET["category4"] && $_GET["category_id"] && !$failure) {
		$browsebycategory = true;
		$sql = "SELECT * FROM ListingCategory WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND friendly_url".$langIndex." = ".db_formatString($_GET["category4"])." LIMIT 1";
		$result = $dbObj->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["category_id"] = $aux["id"];
		if (!$_GET["category_id"]) $failure = true;
	} elseif ($_GET["category4"]) {
		$failure = true;
	}

	if ($_GET["category5"] && $_GET["category_id"] && !$failure) {
		$browsebycategory = true;
		$sql = "SELECT * FROM ListingCategory WHERE category_id = ".db_formatNumber($_GET["category_id"])." AND lang LIKE ".db_formatString("%".EDIR_LANGUAGE."%")." AND friendly_url".$langIndex." = ".db_formatString($_GET["category5"])." LIMIT 1";
		$result = $dbObj->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["category_id"] = $aux["id"];
		if (!$_GET["category_id"]) $failure = true;
	} elseif ($_GET["category5"]) {
		$failure = true;
	}
	##################################################

	##################################################
	# TEMPLATE
	##################################################
	if ($_GET["template"]) {
		$browsebyitem = true;
		$sql = "SELECT ListingTemplate.id as template_id FROM ListingTemplate WHERE ListingTemplate.friendly_url = ".db_formatString($_GET["template"])." LIMIT 1";
		$result = $dbObj->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["template_id"] = $aux["template_id"];
		if (!$_GET["template_id"]) $failure = true;
	}
	##################################################

	##################################################
	# LISTING
	##################################################
	if ($_GET["listing"]) {
		$browsebyitem = true;
		$sql = "SELECT Listing.id as id FROM Listing WHERE Listing.friendly_url = ".db_formatString($_GET["listing"])." LIMIT 1";
		$result = $dbObj->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["id"] = $aux["id"];
		$_GET["listing_id"] = $aux["id"];
		if (!$_GET["id"]) $failure = true;
	}
	##################################################

	##################################################
	# UNSETTING MODREWRITE TERMS
	##################################################
	if ($failure) {
		header("Location: ".LISTING_DEFAULT_URL."/index.php");
		exit;
	} else {
		unset($failure);
		unset($dbObj);
		unset($sql);
		unset($result);
		unset($aux);
		unset($_GET["country"]);
		unset($_GET["state"]);
		unset($_GET["region"]);
		unset($_GET["category1"]);
		unset($_GET["category2"]);
		unset($_GET["category3"]);
		unset($_GET["category4"]);
		unset($_GET["category5"]);
		unset($_GET["template"]);
		unset($_GET["listing"]);
	}
	##################################################

?>
