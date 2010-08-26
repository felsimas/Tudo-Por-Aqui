<?

	/*!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==*\
	######################################################################
	#                                                                    #
	# SisDir Class- System of Class Online 2009           #
	#                                                                    #
	#                #
	#                       #
	#                                                                    #
	# ---------------- 2009 - this file is used in php. ----------------- #
	#                                                                    #
	# http://wxw.google.cn / wxw.msn.cn #
	######################################################################
	\*!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==!==*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/code/validate_querystring.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if ($_GET["id"]) if (!is_numeric($_GET["id"]) || ($_GET["id"] <= 0) || (strpos($_GET["id"], "x") !== false) || (strpos($_GET["id"], ".") !== false)) $_GET["id"] = 0;
	if ($_POST["id"]) if (!is_numeric($_POST["id"]) || ($_POST["id"] <= 0) || (strpos($_POST["id"], "x") !== false) || (strpos($_POST["id"], ".") !== false)) $_POST["id"] = 0;

	if ($_GET["template_id"]) if (!is_numeric($_GET["template_id"]) || ($_GET["template_id"] <= 0) || (strpos($_GET["template_id"], "x") !== false) || (strpos($_GET["template_id"], ".") !== false)) $_GET["template_id"] = 0;
	if ($_POST["template_id"]) if (!is_numeric($_POST["template_id"]) || ($_POST["template_id"] <= 0) || (strpos($_POST["template_id"], "x") !== false) || (strpos($_POST["template_id"], ".") !== false)) $_POST["template_id"] = 0;

	if ($_GET["category_id"]) if (!is_numeric($_GET["category_id"]) || ($_GET["category_id"] <= 0) || (strpos($_GET["category_id"], "x") !== false) || (strpos($_GET["category_id"], ".") !== false)) $_GET["category_id"] = 0;
	if ($_POST["category_id"]) if (!is_numeric($_POST["category_id"]) || ($_POST["category_id"] <= 0) || (strpos($_POST["category_id"], "x") !== false) || (strpos($_POST["category_id"], ".") !== false)) $_POST["category_id"] = 0;

	if ($_GET["estado_id"]) if (!is_numeric($_GET["estado_id"]) || ($_GET["estado_id"] <= 0) || (strpos($_GET["estado_id"], "x") !== false) || (strpos($_GET["estado_id"], ".") !== false)) $_GET["estado_id"] = 0;
	if ($_POST["estado_id"]) if (!is_numeric($_POST["estado_id"]) || ($_POST["estado_id"] <= 0) || (strpos($_POST["estado_id"], "x") !== false) || (strpos($_POST["estado_id"], ".") !== false)) $_POST["estado_id"] = 0;

	if ($_GET["cidade_id"]) if (!is_numeric($_GET["cidade_id"]) || ($_GET["cidade_id"] <= 0) || (strpos($_GET["cidade_id"], "x") !== false) || (strpos($_GET["cidade_id"], ".") !== false)) $_GET["cidade_id"] = 0;
	if ($_POST["cidade_id"]) if (!is_numeric($_POST["cidade_id"]) || ($_POST["cidade_id"] <= 0) || (strpos($_POST["cidade_id"], "x") !== false) || (strpos($_POST["cidade_id"], ".") !== false)) $_POST["cidade_id"] = 0;

	if ($_GET["bairro_id"]) if (!is_numeric($_GET["bairro_id"]) || ($_GET["bairro_id"] <= 0) || (strpos($_GET["bairro_id"], "x") !== false) || (strpos($_GET["bairro_id"], ".") !== false)) $_GET["bairro_id"] = 0;
	if ($_POST["bairro_id"]) if (!is_numeric($_POST["bairro_id"]) || ($_POST["bairro_id"] <= 0) || (strpos($_POST["bairro_id"], "x") !== false) || (strpos($_POST["bairro_id"], ".") !== false)) $_POST["bairro_id"] = 0;

	if ($_GET["city_id"]) if (!is_numeric($_GET["city_id"]) || ($_GET["city_id"] <= 0) || (strpos($_GET["city_id"], "x") !== false) || (strpos($_GET["city_id"], ".") !== false)) $_GET["city_id"] = 0;
	if ($_POST["city_id"]) if (!is_numeric($_POST["city_id"]) || ($_POST["city_id"] <= 0) || (strpos($_POST["city_id"], "x") !== false) || (strpos($_POST["city_id"], ".") !== false)) $_POST["city_id"] = 0;

	if ($_GET["area_id"]) if (!is_numeric($_GET["area_id"]) || ($_GET["area_id"] <= 0) || (strpos($_GET["area_id"], "x") !== false) || (strpos($_GET["area_id"], ".") !== false)) $_GET["area_id"] = 0;
	if ($_POST["area_id"]) if (!is_numeric($_POST["area_id"]) || ($_POST["area_id"] <= 0) || (strpos($_POST["area_id"], "x") !== false) || (strpos($_POST["area_id"], ".") !== false)) $_POST["area_id"] = 0;

	if ($_GET["account_id"]) if (!is_numeric($_GET["account_id"]) || ($_GET["account_id"] <= 0) || (strpos($_GET["account_id"], "x") !== false) || (strpos($_GET["account_id"], ".") !== false)) $_GET["account_id"] = 0;
	if ($_POST["account_id"]) if (!is_numeric($_POST["account_id"]) || ($_POST["account_id"] <= 0) || (strpos($_POST["account_id"], "x") !== false) || (strpos($_POST["account_id"], ".") !== false)) $_POST["account_id"] = 0;

	if ($_GET["listing_id"]) if (!is_numeric($_GET["listing_id"]) || ($_GET["listing_id"] <= 0) || (strpos($_GET["listing_id"], "x") !== false) || (strpos($_GET["listing_id"], ".") !== false)) $_GET["listing_id"] = 0;
	if ($_POST["listing_id"]) if (!is_numeric($_POST["listing_id"]) || ($_POST["listing_id"] <= 0) || (strpos($_POST["listing_id"], "x") !== false) || (strpos($_POST["listing_id"], ".") !== false)) $_POST["listing_id"] = 0;

	if ($_GET["promotion_id"]) if (!is_numeric($_GET["promotion_id"]) || ($_GET["promotion_id"] <= 0) || (strpos($_GET["promotion_id"], "x") !== false) || (strpos($_GET["promotion_id"], ".") !== false)) $_GET["promotion_id"] = 0;
	if ($_POST["promotion_id"]) if (!is_numeric($_POST["promotion_id"]) || ($_POST["promotion_id"] <= 0) || (strpos($_POST["promotion_id"], "x") !== false) || (strpos($_POST["promotion_id"], ".") !== false)) $_POST["promotion_id"] = 0;

	if ($_GET["event_id"]) if (!is_numeric($_GET["event_id"]) || ($_GET["event_id"] <= 0) || (strpos($_GET["event_id"], "x") !== false) || (strpos($_GET["event_id"], ".") !== false)) $_GET["event_id"] = 0;
	if ($_POST["event_id"]) if (!is_numeric($_POST["event_id"]) || ($_POST["event_id"] <= 0) || (strpos($_POST["event_id"], "x") !== false) || (strpos($_POST["event_id"], ".") !== false)) $_POST["event_id"] = 0;

	if ($_GET["banner_id"]) if (!is_numeric($_GET["banner_id"]) || ($_GET["banner_id"] <= 0) || (strpos($_GET["banner_id"], "x") !== false) || (strpos($_GET["banner_id"], ".") !== false)) $_GET["banner_id"] = 0;
	if ($_POST["banner_id"]) if (!is_numeric($_POST["banner_id"]) || ($_POST["banner_id"] <= 0) || (strpos($_POST["banner_id"], "x") !== false) || (strpos($_POST["banner_id"], ".") !== false)) $_POST["banner_id"] = 0;

	if ($_GET["classified_id"]) if (!is_numeric($_GET["classified_id"]) || ($_GET["classified_id"] <= 0) || (strpos($_GET["classified_id"], "x") !== false) || (strpos($_GET["classified_id"], ".") !== false)) $_GET["classified_id"] = 0;
	if ($_POST["classified_id"]) if (!is_numeric($_POST["classified_id"]) || ($_POST["classified_id"] <= 0) || (strpos($_POST["classified_id"], "x") !== false) || (strpos($_POST["classified_id"], ".") !== false)) $_POST["classified_id"] = 0;

	if ($_GET["article_id"]) if (!is_numeric($_GET["article_id"]) || ($_GET["article_id"] <= 0) || (strpos($_GET["article_id"], "x") !== false) || (strpos($_GET["article_id"], ".") !== false)) $_GET["article_id"] = 0;
	if ($_POST["article_id"]) if (!is_numeric($_POST["article_id"]) || ($_POST["article_id"] <= 0) || (strpos($_POST["article_id"], "x") !== false) || (strpos($_POST["article_id"], ".") !== false)) $_POST["article_id"] = 0;

	if ($_GET["dist"]) if (!is_numeric($_GET["dist"]) || ($_GET["dist"] <= 0) || (strpos($_GET["dist"], "x") !== false) || (strpos($_GET["dist"], ".") !== false)) $_GET["dist"] = 0;
	if ($_POST["dist"]) if (!is_numeric($_POST["dist"]) || ($_POST["dist"] <= 0) || (strpos($_POST["dist"], "x") !== false) || (strpos($_POST["dist"], ".") !== false)) $_POST["dist"] = 0;

	if ($_GET["screen"]) if (!is_numeric($_GET["screen"]) || ($_GET["screen"] <= 0) || (strpos($_GET["screen"], "x") !== false) || (strpos($_GET["screen"], ".") !== false)) $_GET["screen"] = 0;
	if ($_POST["screen"]) if (!is_numeric($_POST["screen"]) || ($_POST["screen"] <= 0) || (strpos($_POST["screen"], "x") !== false) || (strpos($_POST["screen"], ".") !== false)) $_POST["screen"] = 0;

	if ($_GET["zip"]) if (strlen($_GET["zip"]) > 10) $_GET["zip"] = "";
	if ($_POST["zip"]) if (strlen($_POST["zip"]) > 10) $_POST["zip"] = "";

	if ($_GET["letra"]) if ((strlen($_GET["letra"]) > 1) && ($_GET["letra"] != "no")) $_GET["letra"] = "";
	if ($_POST["letra"]) if ((strlen($_POST["letra"]) > 1) && ($_POST["letra"] != "no")) $_POST["letra"] = "";

	if ($_GET["searchby"]) if (($_GET["searchby"] != "zipcode") && ($_GET["searchby"] != "location")) $_GET["searchby"] = "";
	if ($_POST["searchby"]) if (($_POST["searchby"] != "zipcode") && ($_POST["searchby"] != "location")) $_POST["searchby"] = "";

	if ($_GET["keyword"]) {
		$_GET["keyword"] = str_replace("%", "", $_GET["keyword"]);
		$_GET["keyword"] = system_denyInjections(trim($_GET["keyword"]));
	}
	if ($_POST["keyword"]) {
		$_POST["keyword"] = str_replace("%", "", $_POST["keyword"]);
		$_POST["keyword"] = system_denyInjections(trim($_POST["keyword"]));
	}

	if ($_GET["where"]) {
		$_GET["where"] = str_replace("%", "", $_GET["where"]);
		$_GET["where"] = system_denyInjections(trim($_GET["where"]));
	}
	if ($_POST["where"]) {
		$_POST["where"] = str_replace("%", "", $_POST["where"]);
		$_POST["where"] = system_denyInjections(trim($_POST["where"]));
	}

?>
